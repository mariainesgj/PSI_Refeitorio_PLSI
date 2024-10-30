<?php
use yii\helpers\Html;

/** @var app\models\Senha $model */
?>

<div class="rounded-container p-3 mb-3">
    <div class="d-flex justify-content-between dish-details">
        <div><?= Html::encode($model->profile ? $model->profile->name : 'N/A') ?></div>
        <div><?= Html::encode($model->profile ? ucfirst($model->profile->role) : 'N/A') ?></div>
        <div><?= Html::encode($model->prato ? $model->prato->designacao : 'N/A') ?></div>
        <div><?= $model->lido === null ? 'Não lido ainda' : Yii::$app->formatter->asTime($model->lido, 'php:H:i') ?></div>

        <?= Html::a('Editar', ['senha/update', 'id' => $model->id], [
            'class' => 'btn text-white',
            'style' => 'background-color: transparent; border: 1px solid white; padding: 5px 10px; margin-right: 10px;'
        ]) ?>

        <?php if ($model->anulado !== 1): ?>
            <?= Html::a('Anular', ['senha/anular', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem certeza que deseja anular esta senha?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </div>
</div>

