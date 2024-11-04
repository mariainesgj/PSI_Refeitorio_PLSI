<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Ementa $model */

$this->title = 'Detalhes da Ementa ' . Yii::$app->formatter->asDate($model->data, 'php:Y/m/d');
$this->params['breadcrumbs'][] = ['label' => 'Ementas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ementa-view">
    <div class="container mt-6">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <div class="mb-4">
                    <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
                </div>
                <h4 class="mb-4" style="color: #50A9B4; text-decoration: underline;">Ementa - <?= Yii::$app->formatter->asDate($model->data, 'php:d/m/Y') ?></h4>

                <div class="mb-3">
                    <label for="pratonormal" style="font-size: 17px; padding-bottom: 0.5vh">Prato Normal:</label>
                    <input type="text" id="pratonormal" class="form-control rounded-input" value="<?= Html::encode($model->prato_normal ? $pratos[$model->prato_normal]->designacao : 'N/A') ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="pratovegetariano" style="font-size: 17px; padding-bottom: 0.5vh">Prato Vegetariano:</label>
                    <input type="text" id="pratovegetariano" class="form-control rounded-input" value="<?= Html::encode($model->prato_vegetariano ? $pratos[$model->prato_vegetariano]->designacao : 'N/A') ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="sopa" style="font-size: 17px; padding-bottom: 0.5vh">Sopa:</label>
                    <input type="text" id="sopa" class="form-control rounded-input" value="<?= Html::encode($model->sopa ? $pratos[$model->sopa]->designacao : 'N/A') ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="sopa" style="font-size: 17px; padding-bottom: 0.5vh">Cozinha Associada:</label>
                    <input type="text" id="cozinha" class="form-control rounded-input" value="<?= Html::encode($cozinha ? $cozinha->designacao : 'N/A') ?>" readonly>
                </div>

                <div class="form-group text-center">
                    <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Tem certeza que deseja excluir este item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>

            <div class="text-center col-md-6">
                <img src="<?= Yii::getAlias('@web/images/ementa.png') ?>" alt="Imagem ilustrativa" class="img-fluid" style="width: 28vw">
            </div>
        </div>
    </div>
</div>

<style>
    .ementa-view {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
