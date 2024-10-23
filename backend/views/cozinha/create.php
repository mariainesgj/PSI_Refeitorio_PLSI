<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cozinha $model */

$this->title = 'Create Cozinha';
$this->params['breadcrumbs'][] = ['label' => 'Cozinhas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cozinha-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
