<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Movimento $model */

$labelOrigem = '';
$labelTipo = '';

if($model->tipo == 'credito'){
    $labelOrigem = 'Origem Fatura nº';
    $labelTipo = 'Crédito';
} else{
    $labelOrigem = 'Origem Senha nº';
    $labelTipo = 'Débito';
}
?>
<div class="my-form">
    <div class="container mt-6">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <h4 class="mb-4" style="color: #50A9B4; text-decoration: underline;">Movimento #<?=$model->id?></h4>
                <div class="mb-4">
                    <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
                </div>

                <div class="mb-3">
                    <label for="tipo" style="font-size: 17px; padding-bottom: 0.5vh">Tipo:</label>
                    <input type="text" id="tipo" class="form-control rounded-input" value="<?= Html::encode($labelTipo) ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="quantidade" style="font-size: 17px; padding-bottom: 0.5vh">Quantidade:</label>
                    <input type="text" id="quantidade" class="form-control rounded-input" value="<?= Html::encode($model->quantidade) ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="origem" style="font-size: 17px; padding-bottom: 0.5vh"><?= Html::encode($labelOrigem) ?></label>
                    <input type="text" id="origem" class="form-control rounded-input" value="<?= Html::encode($model->origem) ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="origem" style="font-size: 17px; padding-bottom: 0.5vh">Utilizador:</label>
                    <input type="text" id="origem" class="form-control rounded-input" value="<?= Html::encode($model->user_id) ?>" readonly>
                </div>
            </div>

            <div class="text-center col-md-6">
                <img src="<?= Yii::getAlias('@web/images/coins.png') ?>" alt="Imagem ilustrativa" class="img-fluid" style="width: 20vw">
            </div>
        </div>
    </div>
</div>

<style>
    .my-form {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .rounded-input {
        background-color: #ffffff;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 10px;
        width: 90%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>
