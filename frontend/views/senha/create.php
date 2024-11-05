<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Senha $model */

?>
<div class="senha-create">

    <?= $this->render('_form', [
        'model' => $model,
        'cozinhaId' => $cozinhaId,
        'userId' => $userId
    ]) ?>

</div>
