<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */

$this->title = 'Update Profile: ' . $model->name;
?>
<div class="profile-update">
    <?= $this->render('_form', [
        'model' => $model,
        'cozinhasList' => $cozinhasList,
    ]) ?>

</div>
