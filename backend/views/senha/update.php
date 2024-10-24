<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Senha $model */

$this->title = 'Update Senha: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Senhas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="senha-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'utilizadoresList' => $utilizadoresList
    ]) ?>

</div>
