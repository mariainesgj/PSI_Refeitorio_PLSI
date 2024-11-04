<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Linhasfatura $model */

?>
<div class="linhasfatura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
