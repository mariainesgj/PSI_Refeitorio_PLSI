<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Fatura $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $utilizadoresList */
/** @var array $utilizadores */
/** @var array $senhas */


$totalValor = 0;
$totalSemIva = 0;
$totalIva = 0;
?>

<div class="my-form">
    <div class="container mt-6" style="max-width: 1200px;">
        <h4 class="mb-4" style="color: #50A9B4; text-decoration: underline;">Fatura</h4>
        <?php $form = ActiveForm::begin(['options' => ['class' => 'needs-validation', 'novalidate' => true]]); ?>

        <div class="mb-3">
            <div class="data-container">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 50%; padding-left: 3vw">
                            <img src="<?= Yii::getAlias('@web/images/logo.png') ?>" alt="Imagem ilustrativa" class="img-fluid" style="width: 18vw">
                        </td>
                        <td style="width: 50%; padding-left: 5px;">
                            <div class="mb-3">
                                <?= Html::dropDownList('user_id', null, $utilizadoresList, [
                                    'prompt' => 'Selecione um utilizador',
                                    'class' => 'form-control dropdown-with-arrow',
                                    'id' => 'senha-user_id',
                                    'onchange' => 'fillUserData()'
                                ]) ?>
                            </div>
                            <div>
                                <p id="street" class="readonly"><span id="street-value"></span></p>
                                <p id="locale" class="readonly"><span id="locale-value"></span></p>
                                <p id="postalCode" class="readonly"><span id="postalCode-value"></span></p>
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="table-responsive mb-3">
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

                        </tbody>
                    </table>
                </div>


                <input type="hidden" id="inputTotalSemIva" name="Fatura[total_iliquido]">
                <input type="hidden" id="inputTotalIva" name="Fatura[total_iva]">
                <input type="hidden" id="inputTotalValor" name="Fatura[total_doc]">

                <div style="margin-top: 7vh; text-align: right;">
                    <div style="display: inline-block; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                    <p id="totalSemIva">Total Ilíquido: <?= Html::encode(number_format($totalSemIva, 2, ',', '.')) ?></p>
                    <p id="totalIva">Total IVA: <?= Html::encode(number_format($totalIva, 2, ',', '.')) ?></p>
                    <p id="totalValor">Total Documento: <?= Html::encode(number_format($totalValor, 2, ',', '.')) ?></p>
                    </div>
                </div>

                <div class="form-group text-center">
                    <?= Html::submitButton('Gerar', ['class' => 'btn btn-lg', 'style' => 'color: #50A9B4; text-decoration: underline;']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <script>
            function fillUserData() {
                const userId = document.getElementById('senha-user_id').value;

                const senhasTableBody = document.querySelector('#senhas-table tbody');
                senhasTableBody.innerHTML = '';

                document.getElementById('street-value').textContent = '';
                document.getElementById('locale-value').textContent = '';
                document.getElementById('postalCode-value').textContent = '';

                if (userId) {
                    fetch(`index.php?r=fatura/get-senhas&userId=${userId}`)
                        .then(response => response.text())
                        .then(data => {
                            senhasTableBody.innerHTML = data;
                            calculateTotals();
                        })
                        .catch(error => console.error('Error fetching senhas:', error));
                }

                const users = document.querySelectorAll('.user-data');
                users.forEach(function(user) {
                    if (user.dataset.id === userId) {
                        document.getElementById('street-value').textContent = user.dataset.street || '';
                        document.getElementById('locale-value').textContent = user.dataset.locale || '';
                        document.getElementById('postalCode-value').textContent = user.dataset.postalcode || '';
                    }
                });
            }

            document.addEventListener('DOMContentLoaded', function() {
                <?php foreach ($utilizadores as $utilizador): ?>
                document.body.insertAdjacentHTML('beforeend', '<div class="user-data" style="display:none;" data-id="<?= $utilizador['id'] ?>" data-street="<?= $utilizador['street'] ?>" data-locale="<?= $utilizador['locale'] ?>" data-postalcode="<?= $utilizador['postalCode'] ?>"></div>');
                <?php endforeach; ?>
            });

            function calculateTotals() {
                const rows = document.querySelectorAll('#senhas-table tbody tr');
                let totalSemIva = 0;
                let totalIva = 0;
                let totalValor = 0;

                rows.forEach(row => {
                    const valorElement = row.querySelector('.valor');
                    const ivaElement = row.querySelector('.iva');

                    const valor = valorElement ? parseFloat(valorElement.textContent.replace('.', '').replace(',', '.')) || 0 : 0;
                    const iva = ivaElement ? parseFloat(ivaElement.textContent.replace('.', '').replace(',', '.')) || 0 : 0;

                    const ivaPercentage = iva / 100;

                    const totalComIva = valor + (valor * ivaPercentage);

                    console.log(`Valor: ${valor}, IVA: ${iva}, Total com IVA: ${totalComIva}`);

                    totalSemIva += valor;
                    totalIva += (valor * ivaPercentage);
                    totalValor += totalComIva;
                });

                console.log(`Total Sem IVA: ${totalSemIva}`);
                console.log(`Total IVA: ${totalIva}`);
                console.log(`Total com IVA: ${totalValor}`);

                const totalSemIvaInput = document.getElementById('inputTotalSemIva');
                const totalIvaInput = document.getElementById('inputTotalIva');
                const totalValorInput = document.getElementById('inputTotalValor');

                if (totalSemIvaInput && totalIvaInput && totalValorInput) {
                    totalSemIvaInput.value = totalSemIva.toFixed(2);
                    totalIvaInput.value = totalIva.toFixed(2);
                    totalValorInput.value = totalValor.toFixed(2);
                } else {
                    console.error('Um ou mais elementos de entrada para os totais não foram encontrados no DOM.');
                }

                document.getElementById('totalSemIva').textContent = totalSemIva.toFixed(2).replace('.', ',');
                document.getElementById('totalIva').textContent = totalIva.toFixed(2).replace('.', ',');
                document.getElementById('totalValor').textContent = totalValor.toFixed(2).replace('.', ',');
            }



        </script>
    </div>
</div>



<style>
    .my-form {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .data-container {
        background-color: #ffffff;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

    .right-aligned {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        width: 300px;
        margin-left: auto;
        margin-right: 0;
        text-align: right;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .right-aligned p {
        margin: 10px 0;
    }
    .column {
        display: flex;
        justify-content: space-between;
        margin: 10px 0;
    }

    .text {
        text-align: left;
        flex: 1;
    }
    .value {
        text-align: right;
        flex: 1;
    }
</style>