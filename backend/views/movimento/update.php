<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Movimento $model */

?>
<div class="movimento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
