<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Cozinha $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cozinha-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'responsavel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'localizacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telemovel')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
