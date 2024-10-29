<?php

use app\models\Senha;
use yii\bootstrap5\Tabs;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var app\models\SenhaSearch $searchModel */

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
                    $senhaModels = $dataProviders[$cozinha->id]->getModels();

                    return [
                        'label' => Html::encode($cozinha->designacao),
                        'content' => !empty($senhaModels) ?
                            implode('', array_map(function($model) {
                                $content = '<div class="rounded-container p-3 mb-3">'
                                    . '<div class="d-flex justify-content-between dish-details">'
                                    . '<div>' . Html::encode($model->profile ? $model->profile->name : 'N/A') . '</div>'
                                    . '<div>' . Html::encode($model->profile ? ucfirst($model->profile->role) : 'N/A') . '</div>'
                                    . '<div>' . Html::encode($model->prato ? $model->prato->designacao : 'N/A') . '</div>'
                                    . '<div>' . ($model->lido === null ? 'Não lido ainda' : Yii::$app->formatter->asTime($model->lido, 'php:H:i')) . '</div>'
                                    . Html::a('Editar', ['senha/update', 'id' => $model->id], [
                                        'class' => 'btn text-white',
                                        'style' => 'background-color: transparent; border: 1px solid white; padding: 5px 10px; margin-right: 10px;'
                                    ]);

                                if ($model->anulado !== 1) {
                                    $content .= Html::a('Anular', ['senha/anular', 'id' => $model->id], [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => 'Tem certeza que deseja anular esta senha?',
                                            'method' => 'post',
                                        ],
                                    ]);
                                }

                                return $content . '</div></div>';
                            }, $senhaModels))
                            : '<p class="text-center" style="margin-top: 3vh">Sem agendamentos para o dia atual.</p>',
                        'active' => $cozinha->id == $activeCozaId,
                    ];
                }, $cozinhas),
                'options' => ['style' => 'padding-bottom: 3.5vh;'],
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

    .rounded-container {
        background-color: #3b99ff;
        border-radius: 10px;
        color: white;
        padding: 20px;
        padding-top: 30px;
    }

    .dish-details {
        margin-top: 10px;
    }
</style>
