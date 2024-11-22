<?php

use yii\helpers\Html;

$this->title = 'Gestão de Utilizadores';
?>
<style>
    .status-circle {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }

    .green {
        background-color: green;
    }

    .red {
        background-color: red;
    }

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

    .white-icon {
        color: white;
    }
</style>
<?php $error = Yii::$app->session->getFlash('error');
if ($error !== null) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
} ?>
<section class="content">
    <div class="cozinha-index">
        <h3 class="mb-4" style="color: #979797;">Utilizadores</h3>
    <div class="card" style="padding: 10px">
        <div class="card-body p-0">
            <table id="reservasTable" class="table table-striped projects">
                <thead>
                <tr>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Estado</th>
                    <th style="width: 16.5%" class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="text-center"><?= Html::encode($user->username) ?></td>
                        <td class="text-center"><?= Html::encode($user->profile->role ?? 'Sem perfil') ?></td>
                        <td class="text-center"><?= Html::encode($user->email) ?></td>
                        <td class="text-center">
                            <?php if ($user->status == 10): ?>
                                <img src="<?= Yii::getAlias('@web/images/led-green.png') ?>" alt="Conta ativa" class="img-fluid" style="width: 1.5vw;">
                            <?php elseif ($user->status == 9): ?>
                                <img src="<?= Yii::getAlias('@web/images/led-off.png') ?>" alt="Conta inativa" class="img-fluid" style="width: 1.5vw;">
                            <?php else: ?>
                                <span class="status-circle"></span>
                            <?php endif; ?>
                        </td>
                        <td class="project-actions text-center">
                            <div class="btn-group">
                                <?= Html::a('<i class="fas fa-folder"></i>', ['user/view', 'user_id' => $user->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= Html::a('<i class="fas fa-pencil-alt white-icon"></i>', ['user/update', 'id' => $user->id], ['class' => 'btn btn-info btn-sm']) ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</section>



<script>
    $(document).ready(function(){
        new DataTable('#reservasTable',  {
            language: {
                emptyTable: "Sem utilizadores para mostrar.",
                search: "Pesquisar:",
                info: "A exibir os utilizadores _START_ a _END_",
                infoEmpty: "Sem utilizadores para exibir",
                infoFiltered: " (dos _MAX_ utilizadores existentes)",
            },
            layout: {
                topStart: {
                    buttons: ['copy', 'excel', 'pdf']
                }
            },
        });
    });
</script>