<?php

use app\models\Cozinha;
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
            <h3 class="mb-4" style="color: #979797;">Cozinhas</h3>

        </div>

        <table id="cozinhasTable" class="table table-bordered rounded-table table-responsive" style="border-collapse: separate; border-spacing: 0;">
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Responsável</th>
                <th class="text-center">Localização</th>
                <th class="text-center">Designação</th>
                <th class="text-center">Telemóvel</th>
                <th class="text-center">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($dataProvider->models as $index => $model): ?>
                <tr>
                    <td class="text-center"><?= $index + 1 ?></td>
                    <td class="text-center"><?= Html::encode($model->responsavel) ?></td>
                    <td class="text-center"><?= Html::encode($model->localizacao) ?></td>
                    <td class="text-center"><?= Html::encode($model->designacao) ?></td>
                    <td class="text-center"><?= Html::encode($model->telemovel) ?></td>
                    <td class="text-center">
                        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?php if ($isAdmin): ?>
                            <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Tem certeza que deseja excluir este item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
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
        new DataTable('#cozinhasTable',  {
            language: {
                emptyTable: "Sem cozinhas para mostrar.",
                search: "Pesquisar:",
                info: "A exibir as cozinhas de _START_ a _END_",
                infoEmpty: "Sem cozinhas para exibir",
                infoFiltered: " (das _MAX_ cozinhas existentes)",
            },
        });
    });
</script>