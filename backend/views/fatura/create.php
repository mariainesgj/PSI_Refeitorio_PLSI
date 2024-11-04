<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Fatura $model */

?>
<div class="fatura-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'utilizadores' => $utilizadores,
        'utilizadoresList' => $utilizadoresList,
    ]) ?>

</div>
