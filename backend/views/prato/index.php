<?php

use app\models\Prato;
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
            <h3 class="mb-4" style="color: #979797;">Pratos</h3>
        </div>

        <table id="pratosTable" class="table table-bordered rounded-table table-responsive" style="border-collapse: separate; border-spacing: 0;">
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Designação</th>
                <th class="text-center">Componentes</th>
                <th class="text-center">Tipo</th>
                <th class="text-center">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($dataProvider->models)): ?>
                <tr>
                    <td colspan="5" class="text-center">Nenhum prato encontrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($dataProvider->models as $index => $model): ?>
                    <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
                        <td class="text-center"><?= Html::encode($model->designacao) ?></td>
                        <td class="text-center"><?= Html::encode($model->componentes) ?></td>
                        <td class="text-center">
                            <?php
                            switch ($model->tipo) {
                                case 'prato normal':
                                    echo 'Normal';
                                    break;
                                case 'prato vegetariano':
                                    echo 'Vegetariano';
                                    break;
                                case 'sopa':
                                    echo 'Sopa';
                                    break;
                                default:
                                    echo 'Desconhecido';
                                    break;
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <?= Html::a('<i class="fas fa-folder"></i>', ['prato/view', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-pencil-alt white-icon"></i>', ['prato/update', 'id' => $model->id], ['class' => 'btn btn-info btn-sm']) ?>
                            </div>
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

     .pagination .page-item {
         margin: 0 5px;
     }

    .pagination .page-link {
        padding: 8px 12px;
    }

    .white-icon {
        color: white;
    }
</style>


<script>
    $(document).ready(function(){
        new DataTable('#pratosTable',  {
            language: {
                emptyTable: "Sem pratos para mostrar.",
                search: "Pesquisar:",
                info: "A exibir os pratos _START_ a _END_",
                infoEmpty: "Sem pratos para exibir",
                infoFiltered: " (dos _MAX_ pratos existentes)",
            },
        });
    });
</script>

