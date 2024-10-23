<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'locale')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postalCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->dropDownList([ 'aluno' => 'Aluno', 'professor' => 'Professor', 'funcionario' => 'Funcionario', 'administrador' => 'Administrador', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
