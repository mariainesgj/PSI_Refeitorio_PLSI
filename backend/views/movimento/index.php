<?php

use app\models\Movimento;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Movimentos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cozinha-index">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-4" style="color: #979797;">Movimentos</h3>

            <div class="mb-3">
                <?= Html::beginForm(['movimento/index'], 'get', ['class' => 'input-group']) ?>
                <?= Html::textInput('MovimentoSearch[data]', $searchModel->data, [
                    'class' => 'form-control',
                    'placeholder' => 'Data',
                    'type' => 'date',
                    'style' => 'border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-top-left-radius: 7px; border-bottom-left-radius: 7px '
                ]) ?>
                <div class="input-group-append">
                    <?= Html::submitButton('Pesquisar', [
                        'class' => 'btn btn-primary ml-2',
                        'id' => 'btn-pesquisar',
                        'style' => 'margin-left: 10px;'
                    ]) ?>
                </div>
                <?= Html::endForm() ?>
            </div>



        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'table-responsive'],
            'tableOptions' => [
                'class' => 'table table-bordered rounded-table',
                'style' => 'border-collapse: separate; border-spacing: 0;'
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'user_id',
                    'header' => 'Utilizador',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'value' => function ($model) {
                        return $model->user ? $model->profile->name : 'Utilizador não encontrado';
                    },
                ],
                [
                    'attribute' => 'quantidade',
                    'header' => 'Quantidade',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center']
                ],
                [
                    'attribute' => 'tipo',
                    'header' => 'Tipo',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'value' => function ($model) {
                        return $model->tipo === 'credito' ? 'Crédito' : ($model->tipo === 'debito' ? 'Débito' : 'Tipo desconhecido');
                    },
                ],
                [
                    'class' => ActionColumn::className(),
                    'header' => 'Ações',
                    'headerOptions' => ['class' => 'text-center'],
                    'urlCreator' => function ($action, Movimento $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                    'contentOptions' => ['class' => 'text-center'],
                ],
            ],
        ]); ?>

        <p class="text-center">
            <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-primary ml-2']) ?>
        </p>
    </div>
</div>

<style>
    .cozinha-index {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }


    .table th, .table td {
        vertical-align: middle;
    }

    .rounded-table {
        border-radius: 10px;
        overflow: hidden;
    }

    .rounded-table th, .rounded-table td {
        border: none;
        padding: 10px;
    }

    .rounded-table th {
        background-color: #ffffff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .rounded-table tr {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

</style>

