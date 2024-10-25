<?php

use app\models\Ementa;
use yii\bootstrap5\Tabs;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider[] $dataProviders */
/** @var app\models\EmentaSearch $searchModel */
/** @var array $cozinhas - array de cozinhas com id e nome */

$this->title = 'Ementas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cozinha-index">
    <div class="container mt-4 align">
        <div class="row align-items-center mb-4">
            <div class="col-auto  me-auto">
                <h3 class="mb-0" style="color: #979797;">Ementas</h3>
            </div>
            <div class="col-auto">
                <?= Html::beginForm(['ementa/index'], 'get', ['class' => 'input-group']) ?>
                <?= Html::textInput('EmentaSearch[data]', $searchModel->data, [
                    'class' => 'form-control',
                    'placeholder' => 'Data',
                    'type' => 'date',
                    'style' => 'border-radius: 7px;'
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

        <!-- Tabs -->
        <?php if (!empty($cozinhas)): ?>
            <?= Tabs::widget([
                'items' => array_map(function($cozinha) use ($dataProviders, $activeCozaId) {
                    return [
                        'label' => Html::encode($cozinha->designacao),
                        'content' => GridView::widget([
                            'dataProvider' => $dataProviders[$cozinha->id] ?? null,
                            'options' => ['class' => 'table-responsive'],
                            'tableOptions' => [
                                'class' => 'table table-bordered rounded-table',
                                'style' => 'border-collapse: separate; border-spacing: 0;',
                            ],
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'data',
                                    'header' => 'Data',
                                    'headerOptions' => ['class' => 'text-center'],
                                    'contentOptions' => ['class' => 'text-center'],
                                    'value' => function ($model) {
                                        return Yii::$app->formatter->asDate($model->data, 'php:Y-m-d');
                                    },
                                ],
                                [
                                    'attribute' => 'prato_normal',
                                    'header' => 'Prato Normal',
                                    'headerOptions' => ['class' => 'text-center'],
                                    'contentOptions' => ['class' => 'text-center'],
                                    'value' => function ($model) {
                                        return $model->getPratoNormal()->one() ? $model->getPratoNormal()->one()->designacao : 'N/A';
                                    },
                                ],
                                [
                                    'attribute' => 'prato_vegetariano',
                                    'header' => 'Prato Vegetariano',
                                    'headerOptions' => ['class' => 'text-center'],
                                    'contentOptions' => ['class' => 'text-center'],
                                    'value' => function ($model) {
                                        return $model->getPratoVegetariano()->one() ? $model->getPratoVegetariano()->one()->designacao : 'N/A';
                                    },
                                ],
                                [
                                    'attribute' => 'sopa',
                                    'header' => 'Sopa',
                                    'headerOptions' => ['class' => 'text-center'],
                                    'contentOptions' => ['class' => 'text-center'],
                                    'value' => function ($model) {
                                        return $model->getSopa()->one() ? $model->getSopa()->one()->designacao : 'N/A';
                                    },
                                ],
                                [
                                    'class' => ActionColumn::className(),
                                    'header' => 'Ações',
                                    'headerOptions' => ['class' => 'text-center'],
                                    'urlCreator' => function ($action, Ementa $model, $key, $index, $column) {
                                        return Url::toRoute([$action, 'id' => $model->id]);
                                    },
                                    'contentOptions' => ['class' => 'text-center'],
                                ],
                            ],
                        ]),
                        'active' => $cozinha->id == $activeCozaId,
                    ];
                }, $cozinhas),
            ]); ?>
        <?php else: ?>
            <p class="text-center">Nenhuma cozinha encontrada.</p>
        <?php endif; ?>

        <!--<div style="background-color: #E9FCFF; border-radius: 15px; padding: 15px; margin-bottom: 20px;">
            <table style="width: 100%;">
                <tbody>
                <tr>
                    <td>Sopa: </td>
                </tr>
                <tr>
                    <td>Prato Normal: </td>
                    <td>Editar</td>
                </tr>
                <tr>
                    <td>Prato Vegetariano: </td>
                </tr>
                </tbody>
            </table>
        </div>-->

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
