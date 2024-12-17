<?php

namespace frontend\controllers;

use app\models\Cozinha;
use app\models\Ementa;
use app\models\Prato;
use app\models\Profile;
use app\models\Senha;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */

    public function actionIndex() {
        $userId = Yii::$app->user->id;
        $profile = \app\models\Profile::find()->where(['user_id' => $userId])->one();

        //var_dump($profile);exit;

        if (!$profile || !$profile->cozinha_id) {
            Yii::$app->session->setFlash('error', 'Cozinha não associada ao seu perfil.');
            return $this->redirect(['site/login']);
        }

        $cozinhaId = $profile->cozinha_id;
        $userName = $profile->name;

        $weekStart = Yii::$app->request->get('week_start') ? new \DateTime(Yii::$app->request->get('week_start')) : new \DateTime('monday this week');
        $weekStart->modify('monday this week');

        $weekDays = [];
        for ($i = 0; $i < 5; $i++) {
            $weekDays[] = $weekStart->format('Y-m-d');
            $weekStart->modify('+1 day');
        }

        $pratos = Prato::find()->indexBy('id')->all();
        $cozinha = Cozinha::findOne($cozinhaId);

        $menus = [];
        foreach ($weekDays as $date) {
            $ementa = Ementa::find()
                ->where(['data' => $date . ' 00:00:00', 'cozinha_id' => $cozinhaId])
                ->one();
            $menus[$date] = $ementa ?? null;
        }

        $senhas = [];
        foreach ($weekDays as $date) {
            $senha = Senha::find()->where(['data' => $date, 'user_id' => $userId])->one();
            $senhas[$date] = $senha !== null;
        }


        return $this->render('index', [
            'cozinha' => $cozinha,
            'weekDays' => $weekDays,
            'menus' => $menus,
            'pratos' => $pratos,
            'userName' => $userName,
            'currentWeekStart' => $weekStart->format('Y-m-d'),
            'senhas' => $senhas,
        ]);
    }


    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['site/login']);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    /*public function actionSignup()
    {
        $cozinhas = Cozinha::find()->all();
        $cozinhasList = \yii\helpers\ArrayHelper::map($cozinhas , 'id' , 'designacao');

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
            'cozinhasList' => $cozinhasList,
        ]);
    }*/

    public function actionSignup()
    {
        $cozinhas = Cozinha::find()->all();
        $cozinhasList = \yii\helpers\ArrayHelper::map($cozinhas, 'id', 'designacao');

        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            $user = $model->signup();

            if ($user) {
                $profile = new Profile();
                $profile->name = '';
                $profile->mobile = '';
                $profile->street = '';
                $profile->locale = '';
                $profile->postalCode = '0000-00';
                $profile->role = $model->role;
                $profile->user_id = $user->id;
                $profile->cozinha_id = (int) $model->cozinha_id;

                if ($profile->save()) {

                    $auth = Yii::$app->authManager;
                    $role = $auth->getRole($profile->role);
                    if ($role) {
                        $auth->assign($role, $user->id);
                    } else {
                        Yii::warning("Tentativa de atribuir um role inválido: {$profile->role}");
                    }

                    Yii::$app->session->setFlash('success', 'Obrigado pelo registo. Por favor, aguarde a aprovação da sua conta.');
                    return $this->redirect(['site/login']);
                } else {
                    Yii::$app->session->setFlash('error', 'Ocorreu um erro ao criar o perfil do utilizador.');
                    echo json_encode($profile->getErrors());
                    exit;
                }
            } else {
                Yii::$app->session->setFlash('error', 'Ocorreu um erro ao criar o utilizador. Tente novamente mais tarde.');
            }
        }

        return $this->render('signup', [
            'model' => $model,
            'cozinhasList' => $cozinhasList,
        ]);
    }



    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
