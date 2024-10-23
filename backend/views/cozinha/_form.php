<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Cozinha $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="cozinha-form">
    <div class="container mt-6">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <h4 class="mb-4" style="color: #50A9B4; text-decoration: underline;">Definir cozinha</h4>
                <?php $form = ActiveForm::begin(['options' => ['class' => 'needs-validation', 'novalidate' => true]]); ?>

                <div class="mb-3">
                    <?= $form->field($model, 'responsavel')
                        ->textInput(['maxlength' => true, 'class' => 'form-control'])
                        ->label('Nome do Responsável:', ['class' => 'form-label'])
                    ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'localizacao')
                        ->textInput(['maxlength' => false, 'class' => 'form-control'])
                        ->label('Localização da Cozinha:', ['class' => 'form-label'])
                    ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'designacao')
                        ->textInput(['maxlength' => true, 'class' => 'form-control'])
                        ->label('Designação da Cozinha:', ['class' => 'form-label'])
                    ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'telemovel')
                        ->textInput(['maxlength' => true, 'class' => 'form-control'])
                        ->label('Número de Telemóvel:', ['class' => 'form-label'])
                    ?>
                </div>

                <div class="form-group text-center">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-lg' , 'style' => 'color: #50A9B4 ;text-decoration: underline; ']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

            <div class="text-center col-md-6">
                <img src="<?= Yii::getAlias('@web/images/cozinha.png') ?>" alt="Imagem ilustrativa" class="img-fluid" style="width: 25vw">
            </div>
        </div>
    </div>
</div>

<style>
    .cozinha-form {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
