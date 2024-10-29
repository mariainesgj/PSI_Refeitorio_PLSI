<?php

use yii\widgets\ListView;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var app\models\EmentaSearch $searchModel */

$this->title = 'Resultados da Pesquisa';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="search-results">
    <div class="container mt-4 d-flex justify-content-between align-items-center"> <!-- Adicionando classes de flexbox -->
        <h3><?= Html::encode($this->title) ?></h3>
        <?= Html::a('Voltar', ['ementa/index'], [
            'class' => 'btn btn-secondary', // Aqui você pode usar a classe que desejar
            'style' => 'margin-left: 10px;'
        ]) ?>
    </div>

    <div class="rounded-container">
        <?php if ($dataProvider->getCount() > 0): ?>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
            ]); ?>
        <?php else: ?>
            <p>Nenhum resultado encontrado.</p>
        <?php endif; ?>
    </div>
</div>

<style>
    .rounded-container {
        background-color: #3b99ff;
        border-radius: 10px;
        padding: 20px;
        color: white;
        margin-top: 20px;
        margin-bottom: 20px;
    }
</style>
