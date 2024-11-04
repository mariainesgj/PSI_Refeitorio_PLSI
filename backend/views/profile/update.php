<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */

$this->title = 'Update Profile: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profile-update">
    <?= $this->render('_form', [
        'model' => $model,
        'cozinhasList' => $cozinhasList,
    ]) ?>

</div>
