<?php

namespace backend\controllers;

use app\models\Cozinha;
use app\models\Senha;
use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

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
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['administrador', 'funcionario'],
                    ],
                    [
                        'allow' => false,
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($activeCozaId = null)
    {
        $cozinhas = Cozinha::find()->all();

        $porServirNormal = 0;
        $servidasNormal = 0;
        $porServirVegetariano = 0;
        $servidasVegetariano = 0;
        $porServirTotal = 0;
        $servidasTotal = 0;

        if ($activeCozaId === null && !empty($cozinhas)) {
            $activeCozaId = $cozinhas[0]->id;
        }

        if ($activeCozaId) {
            $porServirNormal = $this->calcularPorServirNormal($activeCozaId);
            $servidasNormal = $this->calcularServidasNormal($activeCozaId);
            $porServirVegetariano = $this->calcularPorServirVegetariano($activeCozaId);
            $servidasVegetariano = $this->calcularServidasVegetariano($activeCozaId);
            $porServirTotal = $this->calcularPorServirTotal($activeCozaId);
            $servidasTotal = $this->calcularServidasTotal($activeCozaId);
        }

        $dataAtual = date('Y-m-d');

        $senhas = Senha::find()
            ->joinWith(['prato', 'ementa', 'user.profile'])
            ->where(['ementas.cozinha_id' => $activeCozaId])
            ->andWhere(['date(senhas.data)' => $dataAtual])
            ->andWhere(['senhas.consumido' => 1])
            ->all();

        return $this->render('index', [
            'cozinhas' => $cozinhas,
            'activeCozaId' => $activeCozaId,
            'porServirNormal' => $porServirNormal,
            'servidasNormal' => $servidasNormal,
            'porServirVegetariano' => $porServirVegetariano,
            'servidasVegetariano' => $servidasVegetariano,
            'porServirTotal' => $porServirTotal,
            'servidasTotal' => $servidasTotal,
            'senhas' => $senhas
        ]);
    }

    protected function calcularPorServirNormal($cozinhaId)
    {
        $dataAtual = date('Y-m-d');

        $query = Senha::find()
            ->joinWith(['prato', 'ementa'])
            ->where(['ementas.cozinha_id' => $cozinhaId])
            ->andWhere(['senhas.consumido' => 0])
            ->andWhere(['pratos.tipo' => 'prato normal'])
            ->andWhere(['date(senhas.data)' => $dataAtual]);

        return $query->count();
    }

    protected function calcularServidasNormal($cozinhaId)
    {
        $dataAtual = date('Y-m-d');

        return Senha::find()
            ->joinWith(['prato', 'ementa'])
            ->where(['ementas.cozinha_id' => $cozinhaId])
            ->andWhere(['senhas.consumido' => 1])
            ->andWhere(['pratos.tipo' => 'prato normal'])
            ->andWhere(['date(senhas.data)' => $dataAtual])
            ->count();
    }


    protected function calcularPorServirVegetariano($cozinhaId)
    {
        $dataAtual = date('Y-m-d');

        $query = Senha::find()
            ->joinWith(['prato', 'ementa'])
            ->where(['ementas.cozinha_id' => $cozinhaId])
            ->andWhere(['senhas.consumido' => 0])
            ->andWhere(['pratos.tipo' => 'prato vegetariano'])
            ->andWhere(['date(senhas.data)' => $dataAtual]);

        return $query->count();
    }

    protected function calcularServidasVegetariano($cozinhaId)
    {
        $dataAtual = date('Y-m-d');

        return Senha::find()
            ->joinWith(['prato', 'ementa'])
            ->where(['ementas.cozinha_id' => $cozinhaId])
            ->andWhere(['senhas.consumido' => 1])
            ->andWhere(['pratos.tipo' => 'prato vegetariano'])
            ->andWhere(['date(senhas.data)' => $dataAtual])
            ->count();
    }

    protected function calcularPorServirTotal($cozinhaId)
    {
        $dataAtual = date('Y-m-d');

        $query = Senha::find()
            ->joinWith(['ementa'])
            ->where(['ementas.cozinha_id' => $cozinhaId])
            ->andWhere(['senhas.consumido' => 0])
            ->andWhere(['date(senhas.data)' => $dataAtual]);

        return $query->count();
    }

    protected function calcularServidasTotal($cozinhaId)
    {
        $dataAtual = date('Y-m-d');

        return Senha::find()
            ->joinWith(['ementa'])
            ->where(['ementas.cozinha_id' => $cozinhaId])
            ->andWhere(['senhas.consumido' => 1])
            ->andWhere(['date(senhas.data)' => $dataAtual])
            ->count();
    }

    public function actionUpdateReserva()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        try {
            $data = json_decode(Yii::$app->request->getRawBody(), true);
            $id = $data['id'] ?? null;

            if ($id === null) {
                throw new \Exception("ID da reserva não fornecido.");
            }

            $affectedRows = Yii::$app->db->createCommand()
                ->update('senhas', ['consumido' => 1 , 'lido' => new \yii\db\Expression('NOW()')], ['id' => $id])
                ->execute();

            if ($affectedRows === 0) {
                throw new \Exception("Nenhuma reserva encontrada para o ID fornecido.");
            }
            $userId = Yii::$app->db->createCommand("SELECT user_id FROM senhas WHERE id = :id")
                ->bindValue(':id', $id)
                ->queryScalar();

            return [
                'success' => true,
                'message' => 'Senha atualizada com sucesso',
                'user_id' => $userId
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }


    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = Yii::$app->user->identity;

            if (Yii::$app->authManager->checkAccess($user->id, 'administrador') ||
                Yii::$app->authManager->checkAccess($user->id, 'funcionario')) {
                return $this->goBack();
            } else {
                Yii::$app->user->logout();
                Yii::$app->session->setFlash('error', 'Não tem permissão para aceder ao backend.');
                return $this->redirect('http://localhost/refeitorio/frontend/web/index.php?r=site%2Flogin');
            }
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }


    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
