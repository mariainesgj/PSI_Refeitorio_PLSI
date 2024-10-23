<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Linhasfatura $model */

$this->title = 'Create Linhasfatura';
$this->params['breadcrumbs'][] = ['label' => 'Linhasfaturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="linhasfatura-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
