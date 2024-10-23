<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Ementa $model */

$this->title = 'Update Ementa: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ementas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ementa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cozinhasList' => $cozinhasList,
        'pratosNormaisList' => $pratosNormaisList,
        'pratosVegetarianosList' => $pratosVegetarianosList,
        'sopasList' => $sopasList
    ]) ?>

</div>
