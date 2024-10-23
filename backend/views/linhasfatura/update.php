<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Linhasfatura $model */

$this->title = 'Update Linhasfatura: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Linhasfaturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="linhasfatura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
