<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Senha $model */

$this->title = 'Create Senha';
$this->params['breadcrumbs'][] = ['label' => 'Senhas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="senha-create">

    <?= $this->render('_form', [
        'model' => $model,
        'utilizadoresList' => $utilizadoresList
    ]) ?>

</div>
