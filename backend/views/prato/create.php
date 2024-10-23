<?php

use app\models\Cozinha;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Prato $model */

$this->title = 'Create Prato';
$this->params['breadcrumbs'][] = ['label' => 'Pratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="prato-create">
    <?= $this->render('_form', [
        'model' => $model,
        'cozinhasList' => $cozinhasList,
    ]) ?>

</div>
