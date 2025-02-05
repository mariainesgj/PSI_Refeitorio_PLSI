<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Senha $model */

\yii\web\YiiAsset::register($this);
?>
<div class="my-form">
    <div class="container mt-6">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <div class="mb-4">
                    <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
                </div>
                <h4 class="mb-4" style="color: #50A9B4; text-decoration: underline;">Detalhes da Senha #<?= Html::encode($model->id) ?></h4>

                <div class="mb-3">
                    <label class="form-label">Data:</label>
                    <input type="text" class="form-control" value="<?= Yii::$app->formatter->asDate($model->data, 'php:d-m-Y') ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Consumido:</label>
                    <input type="text" class="form-control" value="<?= $model->consumido ? 'Sim' : 'Não' ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Criado em:</label>
                    <input type="text" class="form-control" value="<?= $model->criado ? Yii::$app->formatter->asDatetime($model->criado, 'php:d-m-Y H:i:s') : 'Sem alterações' ?>" readonly>
                </div>


                <div class="mb-3">
                    <label class="form-label">Alterado em:</label>
                    <input type="text" class="form-control" value="<?= $model->alterado ? Yii::$app->formatter->asDatetime($model->alterado, 'php:d-m-Y H:i:s') : 'Sem alterações' ?>" readonly>
                </div>


                <div class="mb-3">
                    <label class="form-label">Descrição:</label>
                    <input type="text" class="form-control" value="<?= Html::encode($model->descricao) ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Utilizador:</label>
                    <input type="text" class="form-control" value="<?= $model->profile ? Html::encode($model->profile->name) : 'Utilizador não encontrado' ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Prato Escolhido:</label>
                    <input type="text" class="form-control" value="<?= Html::encode($model->prato->designacao) ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Lido:</label>
                    <input type="text" class="form-control" value="<?= $model->lido ? 'Sim' : 'Não' ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Valor:</label>
                    <input type="text" class="form-control" value="<?= $model->valor ? Html::encode($model->valor) . ' €' : 'Sem valor' ?>" readonly>
                </div>


                <div class="mb-3">
                    <label class="form-label">Taxa de IVA:</label>
                    <input type="text" class="form-control" value="<?= $model->valor ? Html::encode($model->iva) . ' %' : 'Sem taxa' ?>" readonly>
                </div>
            </div>

            <div class="text-center col-md-6">
                <img src="<?= Yii::getAlias('@web/images/senha.png') ?>" alt="Imagem ilustrativa" class="img-fluid" style="width: 25vw">
            </div>
        </div>

        <?php if ($isAdmin): ?>
        <div class="form-group text-center mt-4">
            <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .my-form {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
