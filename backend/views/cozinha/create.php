<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cozinha $model */

?>
<div class="cozinha-create">

    <?= $this->render('_form', [
        'model' => $model,
        'funcionariosList' => $funcionariosList,
    ]) ?>

</div>
