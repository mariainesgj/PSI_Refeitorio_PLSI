<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Prato $model */

$this->title = 'Create Prato';
$this->params['breadcrumbs'][] = ['label' => 'Pratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prato-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
