<?php

use app\models\Fatura;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="cozinha-index">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-4" style="color: #979797;">Faturas</h3>
        </div>

        <table id="faturasTable" class="table table-bordered rounded-table table-responsive" style="border-collapse: separate; border-spacing: 0;">
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nº da Fatura</th>
                <th class="text-center">Nome</th>
                <th class="text-center">Data</th>
                <th class="text-center">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($dataProvider->models)): ?>
                <tr>
                    <td colspan="5" class="text-center">Nenhuma fatura encontrada.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($dataProvider->models as $index => $model): ?>
                    <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
                        <td class="text-center"><?= Html::encode($model->id) ?></td>
                        <td class="text-center"><?= Html::encode($model->user->profile->name) ?></td>
                        <td class="text-center"><?= Yii::$app->formatter->asDate($model->data, 'php:Y/m/d') ?></td>

                        <td class="text-center">
                            <?= Html::a('<i class="fas fa-eye"></i>', ['fatura/view', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>

        <p class="text-center">
            <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-primary ml-2']) ?>
        </p>
    </div>
</div>

<style>
    .cozinha-index {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .rounded-table {
        border-radius: 10px;
        overflow: hidden;
    }

    .rounded-table th, .rounded-table td {
        border: none;
        padding: 10px;
    }

    .rounded-table th {
        background-color: #ffffff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .rounded-table tr {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }
</style>


<script>
    $(document).ready(function(){
        new DataTable('#faturasTable',  {
            language: {
                emptyTable: "Sem utilizadores para mostrar.",
                search: "Pesquisar:",
                info: "A exibir os utilizadores _START_ a _END_",
                infoEmpty: "Sem utilizadores para exibir",
                infoFiltered: " (dos _MAX_ faturas existentes)",
            },
            layout: {
                topStart: {
                    buttons: ['copy', 'excel', 'pdf']
                }
            },
        });
    });
</script>