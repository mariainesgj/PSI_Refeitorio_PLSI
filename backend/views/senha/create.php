<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Senha $model */

$this->title = 'Create Senha';
$this->params['breadcrumbs'][] = ['label' => 'Senhas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="senha-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'utilizadoresList' => $utilizadoresList
    ]) ?>

</div>
