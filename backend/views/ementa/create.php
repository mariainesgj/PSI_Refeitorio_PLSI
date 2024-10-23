<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Ementa $model */

$this->title = 'Create Ementa';
$this->params['breadcrumbs'][] = ['label' => 'Ementas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ementa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
