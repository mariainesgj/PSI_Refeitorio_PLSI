<?php

namespace frontend\controllers;

use app\models\Cozinha;
use app\models\Ementa;
use app\models\EmentaSearch;
use app\models\Linhascarrinho;
use app\models\Prato;
use app\models\Senha;
use DateTime;
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
    public function actionIndex() {
        $searchModel = new EmentaSearch();
        $dataProviders = [];

        $weekStart = Yii::$app->request->get('week_start') ? new \DateTime(Yii::$app->request->get('week_start')) : new \DateTime();
        $weekStart->modify('monday this week');


        $weekDays = [];
        $menus = [];

        for ($i = 0; $i < 5; $i++) {
            $date = $weekStart->format('Y-m-d');
            $weekDays[] = $date;
            $weekStart->modify('+1 day');
        }

        $pratos = Prato::find()->indexBy('id')->all();
        $cozinhas = \app\models\Cozinha::find()->all();

        if ($cozinhas) {
            $activeCozaId = Yii::$app->request->get('cozinha_id', reset($cozinhas)->id);

            foreach ($cozinhas as $cozinha) {
                foreach ($weekDays as $date) {
                    $formattedDate = (new \DateTime($date))->format('Y-m-d H:i:s');

                    $ementa = Ementa::find()
                        ->where(['data' => $formattedDate, 'cozinha_id' => $cozinha->id])
                        ->one();

                    $menus[$cozinha->id][$date] = $ementa ?? null;
                }

                $query = Ementa::find()->where(['cozinha_id' => $cozinha->id]);

                if ($searchModel->load(Yii::$app->request->queryParams)) {
                    $searchDate = $searchModel->data;
                    if ($searchDate) {
                        $formattedSearchDate = (new \DateTime($searchDate))->format('Y-m-d');
                        $query->andWhere(['data' => $formattedSearchDate]);
                    }
                }

                $dataProviders[$cozinha->id] = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => [
                        'pageSize' => 10,
                    ],
                ]);
            }
        } else {
            $dataProviders = [];
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProviders' => $dataProviders,
            'cozinhas' => $cozinhas,
            'activeCozaId' => $activeCozaId,
            'weekDays' => $weekDays,
            'menus' => $menus,
            'pratos' => $pratos,
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
        $model = $this->findModel($id);

        $senhaExistente = Senha::find()
            ->where(['user_id' => Yii::$app->user->id, 'data' => $model->data])
            ->one();

        $linhasExist = Linhascarrinho::find()
            ->joinWith('carrinho')
            ->where(['carrinhos.user_id' => Yii::$app->user->id])
            ->andWhere(['linhascarrinhos.ementa_id' => $id])
            ->one();

        //var_dump($linhasExist);exit;
        $pratos = Prato::find()->all();

        $pratosMap = [];
        foreach ($pratos as $prato) {
            $pratosMap[$prato->id] = $prato;
        }

        $cozinha = Cozinha::findOne($model->cozinha_id);

        $ementaDateTime = new DateTime($model->data);
        $dataLimite = $ementaDateTime->format('Y-m-d') . ' 11:00:00';

        $now = new DateTime();

        $canMarkMeal = $now < new DateTime($dataLimite);


        return $this->render('view', [
            'model' => $model,
            'pratosMap' => $pratosMap,
            'cozinha' => $cozinha,
            'senhaExistente' => $senhaExistente,
            'linhasExist' => $linhasExist,
            'canMarkMeal' => $canMarkMeal
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

            return $this->asJson($response);
        }
        return $this->asJson(['ementa_id' => null, 'pratos' => []]);
    }


    public function actionSearch()
    {
        $searchModel = new EmentaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $cozinhaId = Yii::$app->request->get('EmentaSearch')['cozinha_id'] ?? null;
        if ($dataProvider->getCount() > 0) {
            $ementas = $dataProvider->getModels();
            foreach ($ementas as $ementa) {
                $ementa->sopa = Prato::findOne($ementa->sopa);
                $ementa->prato_normal = Prato::findOne($ementa->prato_normal);
                $ementa->prato_vegetariano = Prato::findOne($ementa->prato_vegetariano);
            }
        }
        return $this->render('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cozinhaId' => $cozinhaId,
        ]);
    }




}
