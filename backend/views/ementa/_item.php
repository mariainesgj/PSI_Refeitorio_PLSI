<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\Ementa $model */

?>

<div class="ementa-item mb-4">
    <div class="rounded-container p-3">
        <h5 class="text-white" style="text-decoration: underline"><?= Html::encode(Yii::$app->formatter->asDate($model->data, 'php:D, d M Y')) ?></h5>
        <div class="dish-details">
            <div class="soup">
                Sopa: <?= Html::encode($model->sopa ? $model->sopa->designacao : 'N/A') ?>
            </div>
            <div class="main-dish">
                Prato Principal: <?= Html::encode($model->prato_normal ? $model->prato_normal->designacao : 'N/A') ?>
            </div>
            <div class="vegetarian-dish">
                Menu Vegetariano: <?= Html::encode($model->prato_vegetariano ? $model->prato_vegetariano->designacao : 'N/A') ?>
            </div>
        </div>
        <div class="text-center"> <!-- Alterado para text-center -->
            <?= Html::a('Ver Detalhes', Url::to(['ementa/view', 'id' => $model->id]), ['class' => 'btn no-bg']) ?>
        </div>

    </div>
</div>

<style>
    .rounded-container {
        background-color: #3b99ff;
        border-radius: 10px;
        padding: 20px;
        color: white;
        width: 90%;
        max-width: 20vw;
        height: 35vh;
        overflow: hidden;
    }

    .dish-details {
        margin-top: 10px;
    }

    .dish-details div {
        margin: 5px 0;
    }

    .no-bg {
        background-color: transparent;
        color: white;
        text-decoration: underline;
        border: none;
        padding: 0;
        cursor: pointer;
    }

    .no-bg:hover {
        color: #cce0ff;
    }

    .text-center {
        display: flex;
        justify-content: center;
    }
</style>
