<?php

namespace backend\controllers;

use app\models\Cozinha;
use app\models\CozinhaSearch;
use app\models\Profile;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CozinhaController implements the CRUD actions for Cozinha model.
 */
class CozinhaController extends Controller
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
     * Lists all Cozinha models.
     *
     * @return string
     */
    public function actionIndex(){

        $searchModel = new CozinhaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        /*$dataProvider = new ActiveDataProvider([
            'query' => Cozinha::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],

        ]);
*/

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,

        ]);
    }

    /**
     * Displays a single Cozinha model.
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
     * Creates a new Cozinha model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Cozinha();

        $funcionarios = Profile::find()->where(['role' => 'funcionario'])->all();
        $funcionariosList = \yii\helpers\ArrayHelper::map($funcionarios, 'id', 'name');

        if ($this->request->isPost) {
            $data = $this->request->post();
            $model->load($data);

            if (isset($data['Cozinha']['responsavel'])) {
                $responsavelId = $data['Cozinha']['responsavel'];
                $responsavelUser = Profile::findOne($responsavelId);
                if ($responsavelUser) {
                    $model->responsavel = $responsavelUser->name;
                }
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'funcionariosList' => $funcionariosList,
        ]);
    }


    /**
     * Updates an existing Cozinha model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cozinha model.
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
     * Finds the Cozinha model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cozinha the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cozinha::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
