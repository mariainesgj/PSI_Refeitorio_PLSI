<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cozinha $model */

$this->title = 'Update Cozinha: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cozinhas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cozinha-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
