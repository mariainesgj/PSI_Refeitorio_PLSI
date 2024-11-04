<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Criar conta';
?>
<div class="site-signup">
    <div class="row d-flex align-items-center" style="height: 75vh;">
        <div class="col-lg-5">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Preencha os dados para criar uma conta:</p>

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Criar conta', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-lg-7 text-center">
            <?= Html::img('@web/images/logo.png', ['alt' => 'Logotipo', 'class' => 'img-fluid', 'style' => 'width: 23vw;']) ?>
        </div>
    </div>
</div>
