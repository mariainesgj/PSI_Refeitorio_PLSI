<?php

namespace frontend\controllers;

use app\models\Fatura;
use app\models\Linhascarrinho;
use app\models\Linhasfatura;
use app\models\Movimento;
use app\models\Senha;
use app\models\Valor;
use frontend\models\Carrinho;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CarrinhoController implements the CRUD actions for Carrinho model.
 */
class CarrinhoController extends Controller
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
     * Lists all Carrinho models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Carrinho::find(),
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

    public function actionListarCarrinho()
    {
        $carrinho = Carrinho::find()->where(['status' => 'ativo'])->one();
        $linhasCarrinho = Carrinho::getLinhasCarrinho($carrinho->id);
        //var_dump($linhasCarrinho);exit;
        $itens = [];

        foreach ($linhasCarrinho as $linha) {
            $item = [
                'linha_id' => $linha->linha_id,
                'ementa_id' => $linha->ementa_id,
                'prato_id' => $linha->prato_id,
                'ementa_data' => $linha->ementa_data,
                'prato_nome' => $linha->prato_nome,
                'prato_tipo' => $linha->prato_tipo,
                'valor' => $linha->valor,
                'html' => $this->renderPartial('linhacard', ['item' => $linha]),
            ];

            $itens[] = $item;
        }
        header('Content-Type: application/json; charset=utf-8');

        return $this->asJson($itens);
    }

    public function actionCheckout() {

        $carrinho = Carrinho::find()->where(['status' => 'ativo'])->one();

        if (!$carrinho) {
            throw new NotFoundHttpException("Carrinho não encontrado.");
        }

        $linhasCarrinho = Carrinho::getLinhasCarrinho($carrinho->id);

        $fatura = new Fatura();
        $fatura->total_iliquido = 0;
        $fatura->total_iva = 0;
        $fatura->user_id = Yii::$app->user->id;
        $fatura->data = date('Y-m-d');
        $fatura->total_doc = 0;
        if (!$fatura->save()) {
            return $this->renderError("Erro ao criar a fatura.");
        }

        $valorIliquido = 0;
        $valorTotalIva = 0;
        $valorTotal = 0;

        foreach ($linhasCarrinho as $linha) {
            $senha = new Senha();
            $senha->ementa_id = $linha->ementa_id;
            $senha->prato_id = $linha->prato_id;
            $senha->data = Yii::$app->formatter->asDate($linha->ementa_data, 'yyyy-MM-dd');
            $senha->user_id = Yii::$app->user->id;
            $senha->pago = 1;

            if ($senha->save()) {
                $senha = Senha::find()
                    ->where(['data' => $senha->data])
                    ->orderBy(['data' => SORT_DESC])
                    ->one();

                $valor = $senha->valor;
                $iva = $senha->iva;

                $linhaFatura = new Linhasfatura();
                $linhaFatura->quantidade = 1;
                $linhaFatura->preco = $valor;
                $linhaFatura->taxa_iva = $iva;
                $linhaFatura->fatura_id = $fatura->id;
                $linhaFatura->senha_id = $senha->id;
                if ($linhaFatura->save()) {
                    $valorTotal += $linhaFatura->preco;
                    $valorTotalIva += ($linhaFatura->preco * $linhaFatura->taxa_iva) / 100;
                    $valorIliquido += $linhaFatura->preco;
                }

            } else {
                Yii::$app->session->setFlash('error', 'Erro ao criar a senha para a linha do carrinho.');
            }
        }

        $quantidadeLinhasCarrinho = count($linhasCarrinho);

        $movimento = new Movimento();
        $movimento->tipo = 'credito';
        $movimento->data = date('Y-m-d H:i:s');
        $movimento->origem = $fatura->id;
        $movimento->quantidade = $quantidadeLinhasCarrinho;
        $movimento->user_id = Yii::$app->user->id;
        //var_dump($movimento);exit;
        if (!$movimento->save()) {
            Yii::$app->session->setFlash('error', 'Erro ao criar o movimento.');
        }

        $fatura->total_iva = $valorTotalIva;
        $fatura->total_iliquido = $valorTotal;
        $fatura->total_doc = $valorTotalIva + $valorTotal;
        $fatura->save();

        $carrinho->status = 'finalizado';
        if ($carrinho->save()) {
            return $this->redirect(['fatura/view', 'id' => $fatura->id]);
        } else {
            return $this->renderError("Erro ao finalizar o carrinho.");
        }
    }



    /**
     * Displays a single Carrinho model.
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
     * Creates a new Carrinho model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $id = Yii::$app->request->post('ementa_id');
        $pratoId = Yii::$app->request->post('prato_id');
        $userId = Yii::$app->user->id;
        $valor = Valor::findModel(1);
        $carrinhoCount = Carrinho::find()->count();

        if ($valor) {
            $subtotalAoCriar = $valor->valor;
        } else {
            echo 'Preço não encontrado';
        }

        $carrinho = Carrinho::find()
            ->where(['user_id' => $userId, 'status' => 'ativo'])
            ->one();

        if (!$carrinho) {
            $carrinho = new Carrinho();
            $carrinho->subtotal = (float) $subtotalAoCriar;
            $carrinho->user_id = $userId;
            $carrinho->status = 'ativo';
            $numero = 'CAR' . str_pad($carrinhoCount + 1, 4, '0', STR_PAD_LEFT);
            $carrinho->numero = $numero;
            $carrinho->save();
        }

        $linhaCarrinho = new LinhasCarrinho();
        $linhaCarrinho->carrinho_id = $carrinho->id;
        $linhaCarrinho->prato_id = $pratoId;
        $linhaCarrinho->ementa_id = $id;
        $linhaCarrinho->save();


        return $this->redirect(['site/index']);
    }

    /**
     * Updates an existing Carrinho model.
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
     * Deletes an existing Carrinho model.
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
     * Finds the Carrinho model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Carrinho the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Carrinho::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
