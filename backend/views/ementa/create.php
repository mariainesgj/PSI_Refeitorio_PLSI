<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Ementa $model */

$this->title = 'Create Ementa';
$this->params['breadcrumbs'][] = ['label' => 'Ementas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ementa-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
