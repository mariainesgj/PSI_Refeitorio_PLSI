<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Refeitório';
?>
<div class="site-login">
    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1><?= Html::encode($this->title) ?></h1>
                <p>Preencha os campos para efetuar login:</p>

                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group" style="text-align: center">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

            <div class="col-lg-6 text-center">
                <img src="<?= Yii::getAlias('@web/images/logo.png') ?>" alt="Logótipo" class="img-fluid" style="width: 30vw;">
            </div>
        </div>
    </div>
</div>