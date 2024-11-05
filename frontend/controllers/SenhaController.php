<?php

namespace frontend\controllers;

use app\models\Cozinha;
use app\models\Ementa;
use app\models\Prato;
use app\models\Profile;
use app\models\Senha;
use app\models\SenhaSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SenhaController implements the CRUD actions for Senha model.
 */
class SenhaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Senha models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SenhaSearch();
        $dataProviders = [];

        $cozinhas = Cozinha::find()->all();

        $activeCozaId = Yii::$app->request->get('cozinha_id', $cozinhas ? reset($cozinhas)->id : null);
        $searchModel->load(Yii::$app->request->queryParams);

        foreach ($cozinhas as $cozinha) {
            $query = Senha::find()
                ->joinWith('ementa')
                ->where(['ementas.cozinha_id' => $cozinha->id]);

            if (!empty($searchModel->data)) {
                $query->andWhere(['DATE(senhas.data)' => $searchModel->data]);
            } else {
                $query->andWhere(['DATE(senhas.data)' => date('Y-m-d')]);
            }

            $dataProviders[$cozinha->id] = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProviders' => $dataProviders,
            'cozinhas' => $cozinhas,
            'activeCozaId' => $activeCozaId,
        ]);
    }




    /**
     * Displays a single Senha model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Senha model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Senha();

        $userId = Yii::$app->user->id;

        $profile = \app\models\Profile::find()->where(['user_id' => $userId])->one();
        if ($profile) {
            $cozinhaId = $profile->cozinha_id;

            $model->user_id = $userId;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('create', [
            'model' => $model,
            'cozinhaId' => $cozinhaId,
            'userId' => $userId
        ]);
    }


    public function actionGetCozinhaId($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $profile = Profile::find()->where(['user_id' => $id])->one();

        if ($profile) {
            return ['cozinha_id' => $profile->cozinha_id];
        }

        return ['cozinha_id' => null];
    }



    /**
     * Updates an existing Senha model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $userId = Yii::$app->user->id;

        $profile = \app\models\Profile::find()->where(['user_id' => $userId])->one();
        if ($profile) {
            $cozinhaId = $profile->cozinha_id;

            $model->user_id = $userId;
        }

        $utilizadores = Profile::find()->where(['role' => ['aluno', 'professor']])->all();
        $utilizadoresList = \yii\helpers\ArrayHelper::map($utilizadores, 'user_id', 'name');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'utilizadoresList' => $utilizadoresList,
            'cozinhaId' => $cozinhaId,
            'userId' => $userId
        ]);
    }

    /**
     * Deletes an existing Senha model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Senha model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Senha the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Senha::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionAnular($id)
    {
        $model = $this->findModel($id);

        if ($model) {
            $model->anulado = 1;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Senha anulada com sucesso.');
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao anular a senha.');
            }
        } else {
            throw new NotFoundHttpException('Senha não encontrada.');
        }

        return $this->redirect(['index']);
    }

}
