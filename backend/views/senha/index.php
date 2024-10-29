<?php

use app\models\Senha;
use yii\bootstrap5\Tabs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Senhas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cozinha-index">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-4" style="color: #979797;">Senhas</h3>

            <div class="mb-3">
                <?= Html::beginForm(['senha/index'], 'get', ['class' => 'input-group']) ?>
                <?= Html::textInput('SenhaSearch[data]', $searchModel->data, [
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
                                    'attribute' => 'user_id',
                                    'header' => 'Utilizador',
                                    'headerOptions' => ['class' => 'text-center'],
                                    'contentOptions' => ['class' => 'text-center'],
                                    'value' => function ($model) {
                                        return $model->profile ? $model->profile->name : 'N/A';
                                    },
                                ],
                                [
                                    'attribute' => 'prato_id',
                                    'header' => 'Menu Escolhido',
                                    'headerOptions' => ['class' => 'text-center'],
                                    'contentOptions' => ['class' => 'text-center'],
                                    'value' => function ($model) {
                                        return $model->prato ? $model->prato->designacao : 'N/A';
                                    },
                                ],
                                [
                                    'attribute' => 'lido',
                                    'header' => 'Lido',
                                    'headerOptions' => ['class' => 'text-center'],
                                    'contentOptions' => ['class' => 'text-center'],
                                    'value' => function ($model) {
                                        if ($model->lido === null) {
                                            return 'Não lido ainda';
                                        } else {
                                            return Yii::$app->formatter->asTime($model->lido, 'php:H:i');
                                        }
                                    },
                                ],
                                [
                                    'class' => ActionColumn::className(),
                                    'header' => 'Ações',
                                    'headerOptions' => ['class' => 'text-center'],
                                    'urlCreator' => function ($action, Senha $model, $key, $index, $column) {
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



