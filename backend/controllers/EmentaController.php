<?php

namespace backend\controllers;

use app\models\Cozinha;
use app\models\Ementa;
use app\models\Prato;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmentaController implements the CRUD actions for Ementa model.
 */
class EmentaController extends Controller
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
     * Lists all Ementa models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Ementa::find(),
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
     * Displays a single Ementa model.
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
     * Creates a new Ementa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Ementa();
        $pratosNormais = Prato::find()->where(['tipo' => 'prato normal'])->all();
        $pratosNormaisList = \yii\helpers\ArrayHelper::map($pratosNormais, 'id', 'designacao');
        $pratosVegetarianos = Prato::find()->where(['tipo' => 'prato vegetariano'])->all();
        $pratosVegetarianosList = \yii\helpers\ArrayHelper::map($pratosVegetarianos, 'id', 'designacao');
        $sopas = Prato::find()->where(['tipo' => 'sopa'])->all();
        $sopasList = \yii\helpers\ArrayHelper::map($sopas, 'id', 'designacao');

        $cozinhas = Cozinha::find()->all();
        $cozinhasList = \yii\helpers\ArrayHelper::map($cozinhas , 'id' , 'designacao');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'cozinhasList' => $cozinhasList,
            'pratosNormaisList' => $pratosNormaisList,
            'pratosVegetarianosList' => $pratosVegetarianosList,
            'sopasList' => $sopasList
        ]);
    }

    /**
     * Updates an existing Ementa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $pratosNormais = Prato::find()->where(['tipo' => 'prato normal'])->all();
        $pratosNormaisList = \yii\helpers\ArrayHelper::map($pratosNormais, 'id', 'designacao');
        $pratosVegetarianos = Prato::find()->where(['tipo' => 'prato vegetariano'])->all();
        $pratosVegetarianosList = \yii\helpers\ArrayHelper::map($pratosVegetarianos, 'id', 'designacao');
        $sopas = Prato::find()->where(['tipo' => 'sopa'])->all();
        $sopasList = \yii\helpers\ArrayHelper::map($sopas, 'id', 'designacao');

        $cozinhas = Cozinha::find()->all();
        $cozinhasList = \yii\helpers\ArrayHelper::map($cozinhas , 'id' , 'designacao');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'cozinhasList' => $cozinhasList,
            'pratosNormaisList' => $pratosNormaisList,
            'pratosVegetarianosList' => $pratosVegetarianosList,
            'sopasList' => $sopasList
        ]);
    }

    /**
     * Deletes an existing Ementa model.
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
     * Finds the Ementa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Ementa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ementa::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionGetByDateAndCozinha()
    {
        $cozinhaId = Yii::$app->request->get('cozinha_id');
        $data = Yii::$app->request->get('data');

        $ementa = Ementa::find()->where(['cozinha_id' => $cozinhaId, 'data' => $data])->one();

        if ($ementa) {
            $pratos = [];

            $response = [
                'ementa_id' => $ementa->id,
                'pratos' => []
            ];

            if ($ementa->prato_normal) {
                $pratoNormal = Prato::find()->where(['id' => $ementa->prato_normal])->one();
                if ($pratoNormal) {
                    $response['pratos'][] = $pratoNormal;
                }
            }

            if ($ementa->prato_vegetariano) {
                $pratoVegetariano = Prato::find()->where(['id' => $ementa->prato_vegetariano])->one();
                if ($pratoVegetariano) {
                    $response['pratos'][] = $pratoVegetariano;
                }
            }

            if ($ementa->sopa) {
                $sopa = Prato::find()->where(['id' => $ementa->sopa])->one();
                if ($sopa) {
                    $response['pratos'][] = $sopa;
                }
            }
            return $this->asJson($response);
        }
        return $this->asJson(['ementa_id' => null, 'pratos' => []]);
    }


}
