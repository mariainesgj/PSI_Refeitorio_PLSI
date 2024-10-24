<?php

namespace backend\controllers;

use app\models\Profile;
use app\models\Senha;
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
        $dataProvider = new ActiveDataProvider([
            'query' => Senha::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
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

        $utilizadores = Profile::find()->where(['role' => ['aluno', 'professor']])->all();
        $utilizadoresList = \yii\helpers\ArrayHelper::map($utilizadores, 'id', 'name');

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                Yii::info('Dados carregados: ' . print_r($model->attributes, true), __METHOD__);
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::error('Erro ao salvar o modelo: ' . print_r($model->getErrors(), true), __METHOD__);
                }
            } else {
                Yii::warning('Falha ao carregar dados do POST.', __METHOD__);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'utilizadoresList' => $utilizadoresList
        ]);
    }


    public function actionGetCozinhaId($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $profile = Profile::find()->where(['id' => $id])->one();

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

        $utilizadores = Profile::find()->where(['role' => ['aluno', 'professor']])->all();
        $utilizadoresList = \yii\helpers\ArrayHelper::map($utilizadores, 'id', 'name');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'utilizadoresList' => $utilizadoresList
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
}
