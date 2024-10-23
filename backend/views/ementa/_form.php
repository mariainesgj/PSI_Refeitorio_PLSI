<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Ementa $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ementa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'prato_normal')->textInput() ?>

    <?= $form->field($model, 'prato_vegetariano')->textInput() ?>

    <?= $form->field($model, 'sopa')->textInput() ?>

    <?= $form->field($model, 'cozinha_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
