<?php

use app\models\Movimento;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>

<div class="cozinha-index">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-4" style="color: #979797;">Os meus movimentos</h3>
        </div>

        <?php if ($dataProvider->getCount() > 0): ?>
            <?php foreach ($dataProvider->getModels() as $model): ?>
                <div class="movimento-item mb-3 p-3 rounded">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="movimento-detalhes d-flex align-items-center justify-content-between w-100">
                            <span><strong>Tipo:</strong> <?= $model->tipo === 'credito' ? 'Crédito' : ($model->tipo === 'debito' ? 'Débito' : 'Tipo desconhecido') ?></span>
                            <span><strong>Quantidade:</strong> <?= $model->quantidade ?></span>
                            <?= Html::a('Visualizar', Url::to(['view', 'id' => $model->id]), ['class' => 'btn btn-primary ml-3']) ?>
                        </div>
                    </div>
                </div>



            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Sem movimentos para mostrar.</p>
        <?php endif; ?>

    </div>
</div>

<style>
    .cozinha-index {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .movimento-detalhes {
        font-size: 16px;
    }

    .movimento-item {
        background-color: #FFFFFF;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

</style>
