<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Refeitório';
?>
<div class="site-login">
    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>Preencha os campos para efetuar login:</p>

                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>


                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

            <div class="col-lg-7 text-center">
                <img src="<?= Yii::getAlias('@web/images/logo.png') ?>" alt="Logótipo" class="img-fluid" style="width: 25vw">
            </div>
        </div>
    </div>
</div>