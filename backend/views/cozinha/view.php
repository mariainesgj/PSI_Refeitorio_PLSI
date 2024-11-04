<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cozinha $model */

?>
<div class="my-form">
    <div class="container mt-6">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <div class="mb-4">
                    <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
                </div>

                <h4 class="mb-4" style="color: #50A9B4; text-decoration: underline;"><?= Html::encode($model->designacao) ?></h4>

                <div class="mb-3">
                    <label for="responsavel" style="font-size: 17px; padding-bottom: 0.5vh">Responsável:</label>
                    <input type="text" id="responsavel" class="form-control rounded-input" value="<?= Html::encode($model->responsavel) ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="localizacao" style="font-size: 17px; padding-bottom: 0.5vh">Localização:</label>
                    <input type="text" id="localizacao" class="form-control rounded-input" value="<?= Html::encode($model->localizacao) ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="telemovel" style="font-size: 17px; padding-bottom: 0.5vh">Número de Telemóvel:</label>
                    <input type="text" id="telemovel" class="form-control rounded-input" value="<?= Html::encode($model->telemovel) ?>" readonly>
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
                <img src="<?= Yii::getAlias('@web/images/cozinha.png') ?>" alt="Imagem ilustrativa" class="img-fluid" style="width: 25vw">
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
