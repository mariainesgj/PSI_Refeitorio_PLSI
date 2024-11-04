<?php

use app\models\Cozinha;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Prato $model */


?>
<div class="prato-create">
    <?= $this->render('_form', [
        'model' => $model,
        'cozinhasList' => $cozinhasList,
    ]) ?>

</div>
