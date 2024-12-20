<?php

use yii\helpers\Html;
use app\models\Senha;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Ementa $model */

/** @var array $pratos */

?>

<div class="ementa-view">
    <div class="container mt-6">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <div class="mb-4">
                    <?= Html::a('Voltar', ['site/index'], ['class' => 'btn btn-secondary']) ?>
                </div>
                <h4 class="mb-4" style="color: #50A9B4; text-decoration: underline;">Ementa - <?= Yii::$app->formatter->asDate($model->data, 'php:Y/m/d') ?></h4>

                <div class="mb-3">
                    <label for="pratonormal" style="font-size: 17px; padding-bottom: 0.5vh">Prato Normal:</label>
                    <input type="text" id="pratonormal" class="form-control rounded-input"
                           value="<?= Html::encode(isset($pratosMap[$model->prato_normal]) ? $pratosMap[$model->prato_normal]->designacao : 'N/A') ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="pratovegetariano" style="font-size: 17px; padding-bottom: 0.5vh">Prato Vegetariano:</label>
                    <input type="text" id="pratovegetariano" class="form-control rounded-input"
                           value="<?= Html::encode(isset($pratosMap[$model->prato_vegetariano]) ? $pratosMap[$model->prato_vegetariano]->designacao : 'N/A') ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="sopa" style="font-size: 17px; padding-bottom: 0.5vh">Sopa:</label>
                    <input type="text" id="sopa" class="form-control rounded-input"
                           value="<?= Html::encode(isset($pratosMap[$model->sopa]) ? $pratosMap[$model->sopa]->designacao : 'N/A') ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="cozinha" style="font-size: 17px; padding-bottom: 0.5vh">Cozinha Associada:</label>
                    <input type="text" id="cozinha" class="form-control rounded-input" value="<?= Html::encode($cozinha ? $cozinha->designacao : 'N/A') ?>" readonly>
                </div>

                <div class="mb-3">
                    <?php if ($linhasExist): ?>
                        <p style="font-size: 17px; color: red; padding-bottom: 0.5vh">
                            Já tem uma senha para esta data no carrinho.
                        </p>
                    <?php elseif (!$senhaExistente && $canMarkMeal): ?>
                        <label style="font-size: 17px; padding-bottom: 0.5vh">Selecione o prato que deseja reservar:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="prato" id="pratoNormal" value="<?= $model->prato_normal ?>" <?= !$model->prato_normal ? 'disabled' : '' ?>>
                            <label class="form-check-label" for="pratoNormal">
                                <?= Html::encode(isset($pratosMap[$model->prato_normal]) ? $pratosMap[$model->prato_normal]->designacao : 'N/A') ?> (Principal)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="prato" id="pratoVegetariano" value="<?= $model->prato_vegetariano ?>" <?= !$model->prato_vegetariano ? 'disabled' : '' ?>>
                            <label class="form-check-label" for="pratoVegetariano">
                                <?= Html::encode(isset($pratosMap[$model->prato_vegetariano]) ? $pratosMap[$model->prato_vegetariano]->designacao : 'N/A') ?> (Vegetariano)
                            </label>
                        </div>
                    <?php endif; ?>
                </div>


                <div class="mb-4 text-center">
                    <?php if ($senhaExistente): ?>
                        <?= Html::a('Ver Senha', ['senha/view', 'id' => $senhaExistente->id , 'data' => Yii::$app->formatter->asDate($model->data, 'php:Y-m-d')], ['class' => 'btn btn-primary']) ?>
                    <?php elseif ($canMarkMeal): ?>
                        <?php $form = ActiveForm::begin(['action' => ['carrinho/create'], 'method' => 'POST']); ?>
                        <?= Html::hiddenInput('ementa_id', $model->id) ?>
                        <?= Html::hiddenInput('prato_id', null, ['id' => 'pratoId']) ?>

                        <button type="submit" class="btn btn-primary">Adicionar ao carrinho</button>

                        <?php ActiveForm::end(); ?>
                    <?php else: ?>
                        <div class="alert alert-danger">
                            O prazo para marcar esta refeição já expirou.
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <div class="text-center col-md-6">
                <img src="<?= Yii::getAlias('@web/images/ementa.png') ?>" alt="Imagem ilustrativa" class="img-fluid" style="width: 28vw">
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('input[name="prato"]').forEach((radio) => {
        radio.addEventListener('change', function () {
            document.getElementById('pratoId').value = this.value;
            console.log(this.value);
        });
    });
</script>


<style>
    .ementa-view {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
