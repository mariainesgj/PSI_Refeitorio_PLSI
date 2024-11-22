<?php

namespace backend\controllers;

use app\models\Fatura;
use app\models\FaturaSearch;
use app\models\Linhasfatura;
use app\models\Movimento;
use app\models\Profile;
use app\models\Senha;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FaturaController implements the CRUD actions for Fatura model.
 */
class FaturaController extends Controller
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
     * Lists all Fatura models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FaturaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fatura model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $senhas = $model->getLinhasfaturas()->where(['fatura_id' => $id])->all();

        return $this->render('view', [
            'model' => $model,
            'senhas' => $senhas,
        ]);
    }


    /**
     * Creates a new Fatura model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    public function actionCreate()
    {
        $model = new Fatura();
        $utilizadores = Profile::find()
            ->select(['id', 'name', 'locale', 'street', 'postalCode' , 'user_id'])
            ->where(['role' => ['aluno', 'professor']])
            ->asArray()
            ->all();
        $utilizadoresList = \yii\helpers\ArrayHelper::map($utilizadores, 'user_id', 'name');

        //var_dump($utilizadores);exit;

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->total_iliquido = $this->request->post('Fatura')['total_iliquido'];
            $model->total_iva = $this->request->post('Fatura')['total_iva'];
            $model->total_doc = $this->request->post('Fatura')['total_doc'];
            $model->user_id = $this->request->post('user_id');
            $model->data = date('Y-m-d H:i:s');

            if ($model->save()) {
                $senhas = $this->request->post('senhas', []);
                $numeroLinhas = 0;

                foreach ($senhas as $senhaData) {
                    if (isset($senhaData['id'], $senhaData['quantidade'], $senhaData['preco_sem_iva'], $senhaData['taxa_iva'])) {
                        $linhaFatura = new Linhasfatura();
                        $linhaFatura->fatura_id = $model->id;
                        $linhaFatura->senha_id = $senhaData['id'];
                        $linhaFatura->quantidade = $senhaData['quantidade'];
                        $linhaFatura->preco = $senhaData['preco_sem_iva'];
                        $linhaFatura->taxa_iva = str_replace('%', '', $senhaData['taxa_iva']);
                        if ($linhaFatura->save()) {
                            $numeroLinhas++;
                        } else {
                            print_r($linhaFatura->errors);
                            exit;
                        }
                    } else {
                        echo "Dados da senha incompletos.";
                    }
                }

                if (!empty($senhas)) {
                    foreach ($senhas as $senhaData) {
                        $senha = Senha::findOne($senhaData['id']);
                        if ($senha) {
                            $senha->pago = 1;
                            $senha->save();
                        }
                    }
                }

                $movimento = new Movimento();
                $movimento->tipo = "credito";
                $movimento->data = date('Y-m-d H:i:s');
                $movimento->quantidade = $numeroLinhas;
                $movimento->origem = $model->id;
                $movimento->user_id = $model->user_id;

                if (!$movimento->save()) {
                    print_r($movimento->errors);
                    exit;
                }

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                print_r($model->errors);
                exit;
            }
        }

        return $this->render('create', [
            'model' => $model,
            'utilizadoresList' => $utilizadoresList,
            'utilizadores' => $utilizadores,
        ]);
    }

    /**
     * Updates an existing Fatura model.
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
     * Deletes an existing Fatura model.
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
     * Finds the Fatura model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Fatura the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fatura::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionGetSenhas($userId){
        $query = Senha::find()
            ->where(['user_id' => $userId, 'pago' => 0, 'consumido' => 0])
            ->with('valor');

        $sql = $query->createCommand()->getRawSql();

        $senhas = $query->all();

        return $this->renderAjax('_senhas', [
            'senhas' => $senhas,
        ]);
    }


}
