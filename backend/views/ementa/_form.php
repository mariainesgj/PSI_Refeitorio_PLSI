<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Ementa $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ementa-form">
    <div class="container mt-6">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <h4 class="mb-4" style="color: #50A9B4; text-decoration: underline;">Definir ementa</h4>
                <?php $form = ActiveForm::begin(['options' => ['class' => 'needs-validation', 'novalidate' => true]]); ?>

                <div class="mb-3">
                    <?= $form->field($model, 'data')
                        ->textInput(['maxlength' => true, 'class' => 'form-control'])
                        ->label('Data:', ['class' => 'form-label'])
                    ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'prato_normal')
                        ->textInput(['maxlength' => false, 'class' => 'form-control'])
                        ->label('Prato Normal:', ['class' => 'form-label'])
                    ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'prato_vegetariano')
                        ->textInput(['maxlength' => true, 'class' => 'form-control'])
                        ->label('Prato Vegetariano:', ['class' => 'form-label'])
                    ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'sopa')
                        ->textInput(['maxlength' => true, 'class' => 'form-control'])
                        ->label('Sopa:', ['class' => 'form-label'])
                    ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'cozinha_id')
                        ->textInput(['maxlength' => true, 'class' => 'form-control'])
                        ->label('Cozinha associada:', ['class' => 'form-label'])
                    ?>
                </div>

                <div class="form-group text-center">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-lg' , 'style' => 'color: #50A9B4 ;text-decoration: underline; ']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

            <div class="text-center col-md-6">
                <img src="<?= Yii::getAlias('@web/images/ementa.png') ?>" alt="Imagem ilustrativa" class="img-fluid" style="width: 28vw">
            </div>
        </div>
    </div>
</div>

<style>
    .ementa-form {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>