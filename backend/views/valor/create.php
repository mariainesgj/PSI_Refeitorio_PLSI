<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Valor $model */

$this->title = 'Create Valor';
$this->params['breadcrumbs'][] = ['label' => 'Valors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
