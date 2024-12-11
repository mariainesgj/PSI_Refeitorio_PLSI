<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Valor $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="valor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'valor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iva')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
