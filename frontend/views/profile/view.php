<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="profile-view">
    <div class="ementa-view">
        <div class="container mt-6">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <div class="mb-4">
                        <?= Html::a('Voltar', ['site/index'], ['class' => 'btn btn-secondary']) ?>
                    </div>
                    <h4 class="mb-4" style="color: #50A9B4; text-decoration: underline;">Os meus dados</h4>

                    <div class="mb-3">
                        <label for="name" style="font-size: 17px; padding-bottom: 0.5vh">Nome:</label>
                        <input type="text" id="name" class="form-control rounded-input" value="<?= Html::encode($model->name) ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="mobile" style="font-size: 17px; padding-bottom: 0.5vh">Telemóvel:</label>
                        <input type="text" id="mobile" class="form-control rounded-input" value="<?= Html::encode($model->mobile) ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="street" style="font-size: 17px; padding-bottom: 0.5vh">Rua:</label>
                        <input type="text" id="street" class="form-control rounded-input" value="<?= Html::encode($model->street) ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="locale" style="font-size: 17px; padding-bottom: 0.5vh">Cidade:</label>
                        <input type="text" id="locale" class="form-control rounded-input" value="<?= Html::encode($model->locale) ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="postalCode" style="font-size: 17px; padding-bottom: 0.5vh">Código-Postal:</label>
                        <input type="text" id="postalCode" class="form-control rounded-input" value="<?= Html::encode($model->postalCode) ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="cozinha_id" style="font-size: 17px; padding-bottom: 0.5vh">Cozinha:</label>
                        <input type="text" id="cozinha_id" class="form-control rounded-input" value="<?= Html::encode($cozinha ? $cozinha->designacao : 'N/A') ?>" readonly>
                    </div>


                    <div class="form-group text-center">
                        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

                    </div>
                </div>

                <div class="text-center col-md-6">
                    <img src="<?= Yii::getAlias('@web/images/dados.png') ?>" alt="Imagem ilustrativa" class="img-fluid" style="width: 23vw">
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .ementa-view {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

