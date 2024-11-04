<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Ementa $model */

?>
<div class="ementa-update">

    <?= $this->render('_form', [
        'model' => $model,
        'cozinhasList' => $cozinhasList,
        'pratosNormaisList' => $pratosNormaisList,
        'pratosVegetarianosList' => $pratosVegetarianosList,
        'sopasList' => $sopasList
    ]) ?>

</div>
