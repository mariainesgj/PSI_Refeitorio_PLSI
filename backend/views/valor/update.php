<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="my-form">
    <div class="container mt-6">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <div class="mb-4">
                    <?= Html::a('Voltar', ['site/index'], ['class' => 'btn btn-secondary']) ?>
                </div>

                <h4 class="mb-4" style="color: #50A9B4; text-decoration: underline;">Editar preço</h4>
                <?php $form = ActiveForm::begin(['options' => ['class' => 'needs-validation', 'novalidate' => true]]); ?>

                <div class="mb-3">
                    <?= $form->field($model, 'valor')
                        ->textInput(['maxlength' => true, 'class' => 'form-control'])
                        ->label('Preço:', ['class' => 'form-label'])
                    ?>
                </div>

                <div class="form-group text-center">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-lg' , 'style' => 'color: #50A9B4 ;text-decoration: underline; ']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

            <div class="text-center col-md-6">
                <img src="<?= Yii::getAlias('@web/images/coins.png') ?>" alt="Imagem ilustrativa" class="img-fluid" style="width: 15vw">
            </div>
        </div>
    </div>
</div>

<style>
    .my-form {
        background-color: #ffffff;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>


