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

            <?= $form->field($model, 'cozinha_id')
                ->dropDownList($cozinhasList, ['prompt' => 'Selecione uma cozinha.', 'class' => 'form-control dropdown-with-arrow'])
                ->label('Cozinha associada:', ['class' => 'form-label'])
            ?>

            <?= $form->field($model, 'role')
                ->dropDownList(
                    ['professor' => 'Professor', 'aluno' => 'Aluno'],
                    ['class' => 'form-control dropdown-with-arrow']
                )
                ->label('Sou...', ['class' => 'form-label'])
            ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

                <p style="font-size: 14px; text-align: center">
                    Se já possuir uma conta,
                    <?= \yii\helpers\Html::a('inicie sessão', ['site/login'], ['class' => 'text-primary']) ?>
                </p>


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
