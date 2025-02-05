<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Senha $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="my-form">
    <div class="container mt-6">
        <div class="row d-flex align-items-center">
            <div class="col-md-6">
                <div class="mb-4">
                    <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-secondary']) ?>
                </div>
                <h4 class="mb-4" style="color: #50A9B4; text-decoration: underline;">Agendar refeição</h4>
                <?php $form = ActiveForm::begin(); ?>

                <div class="mb-3">
                    <?php if ($model->isNewRecord): ?>
                        <?= $form->field($model, 'data')
                            ->input('date', ['class' => 'form-control', 'id' => 'senha-data'])
                            ->label('Data:', ['class' => 'form-label']) ?>
                    <?php else: ?>
                        <label class="form-label">Data:</label>
                        <div class="form-control" readonly>
                            <?= Yii::$app->formatter->asDate($model->data, 'php:d-m-Y') ?>
                        </div>
                        <?= Html::hiddenInput('hidden_data', $model->data, ['id' => 'senha-hidden-data']) ?>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'descricao')
                        ->textInput(['maxlength' => false, 'class' => 'form-control'])
                        ->label('Descrição:', ['class' => 'form-label'])
                    ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'user_id')
                        ->dropDownList($utilizadoresList, ['prompt' => 'Selecione um utilizador', 'class' => 'form-control dropdown-with-arrow', 'id' => 'senha-user_id'])
                        ->label('Utilizador:', ['class' => 'form-label'])
                    ?>
                </div>

                <?= $form->field($model, 'ementa_id')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'prato_id')->dropDownList([], ['prompt' => 'Selecione um prato', 'class' => 'form-control dropdown-with-arrow', 'id' => 'senha-prato_id']) ?>

                <div class="form-group text-center">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-lg' , 'style' => 'color: #50A9B4 ;text-decoration: underline; ']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

            <div class="text-center col-md-6">
                <img src="<?= Yii::getAlias('@web/images/senha.png') ?>" alt="Imagem ilustrativa" class="img-fluid" style="width: 25vw">
            </div>
        </div>
    </div>
</div>

<style>
    .my-form {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .dropdown-with-arrow {
        position: relative;
        background: #fff;
        padding-right: 30px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%2350A9B4'%3E%3Cpath d='M5.23 7.21a.75.75 0 011.04-.02L10 10.39l3.73-3.2a.75.75 0 111.02 1.1l-4.25 3.65a.75.75 0 01-1.02 0L5.23 8.3a.75.75 0 01-.02-1.08z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 16px;
    }
</style>



<?php
$script = <<< JS
$(document).ready(function() {
    var userId = $('#senha-user_id').val();
    var data = $('#senha-hidden-data').val() || $('#senha-data').val();
    
    if (userId && data) {
        console.log("A carregaar a  ementa e pratos na vista update para user_id: " + userId + " e data: " + data);
        fetchCozinhaIdAndEmenta(userId, data);
    }

    $('#senha-user_id').change(function() {
        userId = $(this).val();
        data = $('#senha-hidden-data').val() || $('#senha-data').val();
        if (userId && data) {
            console.log("Fetching cozinha for user id: " + userId + " and data: " + data);
            fetchCozinhaIdAndEmenta(userId, data);
        }
    });
    
    $('#senha-data').change(function() {
        data = $(this).val();
        userId = $('#senha-user_id').val();
        if (userId && data) {
            console.log("Fetching cozinha and ementa for user id: " + userId + " and date: " + data);
            fetchCozinhaIdAndEmenta(userId, data);
        }
    });
});


function fetchCozinhaIdAndEmenta(userId, data) {
    $.ajax({
        url: 'index.php?r=senha/get-cozinha-id&id=' + userId,
        type: 'GET',
        success: function(cozinhaData) {
            console.log("Cozinha data received:", cozinhaData);
            if (cozinhaData.cozinha_id) {
                fetchEmentaId(cozinhaData.cozinha_id, data);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error while fetching cozinha:", status, error);
        }
    });
}

function fetchEmentaId(cozinhaId, data) {
    if (data) {
        $.ajax({
            url: 'index.php?r=ementa/get-by-date-and-cozinha',
            type: 'GET',
            data: { cozinha_id: cozinhaId, data: data },
            success: function(ementaData) {
                console.log('Ementa data received:', ementaData);
                if (ementaData && ementaData.ementa_id) {
                    $('#senha-ementa_id').val(ementaData.ementa_id);

                    if (ementaData.pratos && ementaData.pratos.length > 0) {
                        var options = '<option value="">Selecione um prato</option>';
                        $.each(ementaData.pratos, function(index, prato) {
                            options += '<option value="' + prato.id + '">' + prato.designacao + '</option>';
                        });
                        $('#senha-prato_id').html(options);
                    } else {
                        $('#senha-prato_id').html('<option value="">Nenhum prato encontrado</option>');
                    }
                } else {
                    $('#senha-prato_id').html('<option value="">Nenhuma ementa encontrada</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error while fetching ementa:", status, error);
            }
        });
    }
}


$('form').on('submit', function(event) { //Impede enviar o formulário mais que uma vez (bug fixed: permitia vários registos) 
    event.preventDefault();
    var form = this;
    $(this).find(':submit').prop('disabled', true);
    console.log("Dados do formulário:", $(this).serialize());
    form.submit();
});


JS;
$this->registerJs($script);
?>
