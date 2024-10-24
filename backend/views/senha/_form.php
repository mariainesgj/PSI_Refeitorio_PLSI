<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Senha $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="senha-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="mb-3">
        <?= $form->field($model, 'data')
            ->input('date', ['class' => 'form-control', 'id' => 'senha-data'])
            ->label('Data:', ['class' => 'form-label'])
        ?>
    </div>

    <div class="mb-3">
        <?= $form->field($model, 'valor')
            ->textInput(['maxlength' => false, 'class' => 'form-control'])
            ->label('Valor:', ['class' => 'form-label'])
        ?>
    </div>

    <div class="mb-3">
        <?= $form->field($model, 'descricao')
            ->textInput(['maxlength' => false, 'class' => 'form-control'])
            ->label('Descrição:', ['class' => 'form-label'])
        ?>
    </div>

    <div class="mb-3">
        <?= $form->field($model, 'iva')
            ->dropDownList(
                [
                    '6' => 'Taxa reduzida - 6%',
                    '13' => 'Taxa intermédia - 13%',
                    '23' => 'Taxa normal - 23%',
                ],
                ['prompt' => 'Selecione uma taxa.', 'class' => 'form-control dropdown-with-arrow']
            )
            ->label('Iva:', ['class' => 'form-label'])
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

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
$(document).ready(function() {
    $('#senha-user_id').change(function() {
        var userId = $(this).val();
        var data = $('#senha-data').val();

        if (userId) {
            console.log("Fetching cozinha for user id: " + userId);
            $.ajax({
                url: 'index.php?r=senha/get-cozinha-id&id=' + userId,
                type: 'GET',
                success: function(data) {
                    console.log("Cozinha data received:", data);
                    if (data.cozinha_id) {
                        fetchEmentaId(data.cozinha_id);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error while fetching cozinha:", status, error);
                }
            });
        }
    });

    $('#senha-data').change(function() {
        var userId = $('#senha-user_id').val();
        var data = $(this).val();

        if (userId && data) {
            $.ajax({
                url: 'index.php?r=senha/get-cozinha-id&id=' + userId,
                type: 'GET',
                success: function(cozinhaData) {
                    console.log("Cozinha data received on date change:", cozinhaData);
                    if (cozinhaData.cozinha_id) {
                        fetchEmentaId(cozinhaData.cozinha_id);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error while fetching cozinha:", status, error);
                }
            });
        }
    });
});

function fetchEmentaId(cozinhaId) {
    var data = $('#senha-data').val();
    if (data) {
        $.ajax({
            url: 'index.php?r=ementa/get-by-date-and-cozinha',
            type: 'GET',
            data: {cozinha_id: cozinhaId, data: data},
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
                    console.warn('Nenhuma ementa encontrada.');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error while fetching ementa:", status, error);
            }
        });
    }
}

$('form').on('submit', function(event) {
        event.preventDefault(); 
        console.log("Dados do formulário:", $(this).serialize());
        this.submit();
    });

JS;
$this->registerJs($script);
?>
