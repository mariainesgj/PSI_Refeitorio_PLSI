<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="my-form">
    <div class="container mt-6">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <div class="mb-4">
                    <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
                </div>

                <h4 class="mb-4" style="color: #50A9B4; text-decoration: underline;">Editar estado da conta: <?= $model->profile->name ?? ''?></h4>

                <?php $form = ActiveForm::begin(['options' => ['class' => 'needs-validation', 'novalidate' => true]]); ?>

                <div class="mb-3">
                    <?= $form->field($model, 'status')
                        ->dropDownList(
                            [10 => 'Ativo', 9 => 'Inativo'],
                            ['class' => 'form-control dropdown-with-arrow']
                        )
                        ->label('Estado da conta:', ['class' => 'form-label'])
                    ?>
                </div>

                <div class="form-group text-center">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-lg' , 'style' => 'color: #50A9B4 ;text-decoration: underline; ']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

            <div class="text-center col-md-6">
                <img src="<?= Yii::getAlias('@web/images/dados.png') ?>" alt="Imagem ilustrativa" class="img-fluid" style="width: 23vw">
            </div>

            <style>
                .my-form {
                    background-color: #f8f9fa;
                    border-radius: 5px;
                    padding: 20px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    vertical-align: center;
                }

                .dropdown-with-arrow {
                    position: relative;
                    background: #fff;
                    padding-right: 30px;
                    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%2350A9B4'%3E%3Cpath d='M5.23 7.21a.75.75 0 011.04-.02L10 10.39l3.73-3.2a.75.75 0 111.02 1.1l-4.25 3.65a.75.75 0 01-1.02 0L5.23 8.3a.75.75 0 01-.02-1.08z'/%3E%3C/svg%3E");
                    background-repeat: no-repeat;
                    background-position: right 10px center;
                    background-size: 16px;
                }
            </style>