<?php

use app\models\Prato;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pratos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cozinha-index">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-4" style="color: #979797;">Pratos</h3>

            <div class="mb-3">
                <?= Html::beginForm(['prato/index'], 'get', ['class' => 'input-group']) ?>
                <?= Html::textInput('PratoSearch[designacao]', $searchModel->designacao, [
                    'class' => 'form-control',
                    'placeholder' => 'Designação',
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
            'emptyText' => 'Nenhum prato encontrado.',
            'pager' => [
                'options' => [
                    'class' => 'pagination justify-content-center',
                ],
                'linkOptions' => [
                    'class' => 'page-link',
                ],
                'activePageCssClass' => 'active',
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'designacao',
                    'header' => 'Designação',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'attribute' => 'componentes',
                    'header' => 'Componentes',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'attribute' => 'tipo',
                    'header' => 'Tipo',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'value' => function ($model) {
                        switch ($model->tipo) {
                            case 'prato normal':
                                return 'Normal';
                            case 'prato vegetariano':
                                return 'Vegetariano';
                            case 'sopa':
                                return 'Sopa';
                            default:
                                return 'Desconhecido';
                        }
                    },
                ],
                [
                    'class' => ActionColumn::className(),
                    'header' => 'Ações',
                    'headerOptions' => ['class' => 'text-center'],
                    'urlCreator' => function ($action, Prato $model, $key, $index, $column) {
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

     .pagination .page-item {
         margin: 0 5px;
     }

    .pagination .page-link {
        padding: 8px 12px;
    }
</style>



</style>

