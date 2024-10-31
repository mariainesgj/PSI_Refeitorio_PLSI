<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Prato $model */

$this->title = 'Update Prato: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prato-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
