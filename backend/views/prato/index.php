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
<div class="prato-index">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0" style="color: #979797;"><?= Html::encode($this->title) ?></h3>
            <p class="mb-0">
                <?= Html::a('Criar Prato', ['create'], ['class' => 'btn btn-success btn-lg']) ?>
            </p>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'table-responsive'],
            'tableOptions' => ['class' => 'table table-striped table-bordered'],
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
    </div>
</div>

<style>
    .prato-index {
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
