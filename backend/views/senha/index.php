<?php

use app\models\Senha;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Senhas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="senha-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Senha', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'data',
            'anulado',
            'consumido',
            'criado',
            //'alterado',
            //'valor',
            //'descricao',
            //'iva',
            //'user_id',
            //'ementa_id',
            //'prato_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Senha $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
