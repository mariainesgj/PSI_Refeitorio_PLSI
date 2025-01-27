<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Fatura $model */
/** @var array $utilizadores */

?>

<div class="fatura-view">
    <div class="container mt-6" style="max-width: 1200px;">
        <div class="mb-4">
            <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>
        <h4 class="mb-4" style="color: #50A9B4; text-decoration: underline;">Fatura nº <?=$model->id?></h4>

        <div class="data-container">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; padding-left: 3vw">
                        <img src="<?= Yii::getAlias('@web/images/logo.png') ?>" alt="Imagem ilustrativa" class="img-fluid" style="width: 18vw">
                    </td>
                    <td style="width: 50%; text-align: center;">
                        <div style="display: inline-block; text-align: left;">
                            <p><?= Html::encode($model->userProfile ? $model->userProfile->name : 'Não especificado') ?></p>
                            <p><?= Html::encode($model->userProfile ? $model->userProfile->street : 'Não especificado') ?></p>
                            <p><?= Html::encode($model->userProfile ? $model->userProfile->locale : 'Não especificado') ?></p>
                            <p><?= Html::encode($model->userProfile ? $model->userProfile->postalCode : 'Não especificado') ?></p>
                        </div>
                    </td>

                </tr>
            </table>

            <div class="table-responsive mb-3" style="padding-top: 2.5vh">
                <table class="table" style="width: 100%; border: none;" id="senhas-table">
                    <thead>
                    <tr>
                        <th style="text-align: center;">Nº da Senha</th>
                        <th style="text-align: center;">Quantidade</th>
                        <th style="text-align: center;">Preço Sem Iva</th>
                        <th style="text-align: center;">Taxa de Iva</th>
                        <th style="text-align: center;">Total com Iva</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($senhas as $senha): ?>
                        <tr>
                            <td style="text-align: center;"><?= Html::encode($senha->senha_id) ?></td>
                            <td style="text-align: center;"><?= Html::encode($senha->quantidade) ?></td>
                            <td style="text-align: center;"><?= Html::encode(number_format($senha->preco, 2, ',', '.')) ?>€</td>
                            <td style="text-align: center;"><?= Html::encode($senha->taxa_iva) ?>%</td>

                            <?php $totalComIva = $senha->preco * (1 + $senha->taxa_iva / 100); ?>

                            <td style="text-align: center;"><?= Html::encode(number_format($totalComIva, 2, ',', '.')) ?>€</td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 7vh; text-align: right;">
                <div style="display: inline-block; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                    <p><strong>Total Ilíquido:</strong> <?= Html::encode(number_format($model->total_iliquido, 2, ',', '.')) ?>€</p>
                    <p><strong>Total IVA:</strong> <?= Html::encode(number_format($model->total_iva, 2, ',', '.')) ?>€</p>
                    <p><strong>Total Documento:</strong> <?= Html::encode(number_format($model->total_doc, 2, ',', '.')) ?>€</p>
                </div>
            </div>

        </div>

        <!--<div class="form-group text-center mt-4">
            < ?= Html::a('Download', ['download', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </div>-->

    </div>
</div>

<style>
    .fatura-view .data-container {
        background-color: #ffffff;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .fatura-view table.table th,
    .fatura-view table.table td {
        text-align: center;
    }
</style>

