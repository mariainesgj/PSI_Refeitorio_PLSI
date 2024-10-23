<?php

use app\models\Ementa;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ementas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cozinha-index">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-4" style="color: #979797;">Ementas</h3>
            <p class="mb-0">
                <?= Html::a('Criar', ['create'], ['class' => 'btn btn-success btn-lg']) ?>
            </p>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'table-responsive'],
            'tableOptions' => ['class' => 'table table-striped table-bordered'],
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
                    }
                ],
                [
                    'attribute' => 'prato_vegetariano',
                    'header' => 'Prato Vegetariano',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'value' => function ($model) {
                        return $model->getPratoVegetariano()->one() ? $model->getPratoVegetariano()->one()->designacao : 'N/A';
                    }
                ],
                [
                    'attribute' => 'sopa',
                    'header' => 'Sopa',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'value' => function ($model) {
                        return $model->getSopa()->one() ? $model->getSopa()->one()->designacao : 'N/A';
                    }
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
        ]); ?>

    </div>
</div>

<style>
    .cozinha-index {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .table th, .table td {
        vertical-align: middle;
    }
</style>
