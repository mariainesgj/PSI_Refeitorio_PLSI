<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Senha $model */

?>
<div class="senha-update">

    <?= $this->render('_form', [
        'model' => $model,
        'utilizadoresList' => $utilizadoresList,
        'cozinhaId' => $cozinhaId,
        'userId' => $userId
    ]) ?>

</div>
