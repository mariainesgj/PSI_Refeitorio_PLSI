<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cozinha $model */

?>
<div class="cozinha-update">
    <?= $this->render('_form', [
        'model' => $model,
        'funcionariosList' => $funcionariosList,
    ]) ?>

</div>
