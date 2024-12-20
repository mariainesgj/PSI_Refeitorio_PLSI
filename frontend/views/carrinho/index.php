<?php

use yii\helpers\Html;

?>
<div class="site-index">
    <div class="body-content">
        <div class="ementa-semana">
            <div class="container mt-3">
                <h5>O meu carrinho</h5>

                <?php foreach ($itens as $item): ?>
                    <div class="col">
                        <div class="card" style="min-height: 11vh; margin-top: 10px;">
                            <div class="card-body">
                                <div class="row" style="display: flex; align-items: center; justify-content: center;">
                                    <div class="col-3 text-center">
                                        <?php if ($item['prato_tipo'] === 'prato vegetariano'): ?>
                                            <h6>
                                                <img src="<?= Yii::getAlias('@web/images/folha.png') ?>"
                                                     alt="Imagem ilustrativa"
                                                     class="img-fluid" style="height: 4vh;">
                                            </h6>
                                        <?php elseif ($item['prato_tipo'] === 'prato normal'): ?>
                                            <h6>
                                                <img src="<?= Yii::getAlias('@web/images/talheres.png') ?>"
                                                     alt="Imagem ilustrativa"
                                                     class="img-fluid" style="height: 4vh;">
                                            </h6>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-6">
                                        <h6 class="card-subtitle" style="font-weight: lighter; margin-bottom: 8px;">
                                            <?= Yii::$app->formatter->asDate($item['ementa_data'], 'yyyy-MM-dd') ?>
                                        </h6>
                                        <h6 class="card-subtitle" style="font-weight: lighter; margin-bottom: 8px;">
                                            <?= $item['prato_nome'] ?>
                                        </h6>
                                        <h6 class="card-subtitle" style="font-weight: lighter; margin-bottom: 8px;">
                                            <?= $item['valor'] ?>€
                                        </h6>
                                    </div>

                                    <div class="col-3 text-center">
                                        <form id="delete-form-<?= $item['linha_id'] ?>"
                                              action="<?= \yii\helpers\Url::to(['linhascarrinho/delete', 'id' => $item['linha_id']]) ?>"
                                              method="post" style="display: inline;">
                                            <?= \yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                                            <button type="button" onclick="confirmDelete(<?= $item['linha_id'] ?>)"
                                                    style="background: none; border: none; padding: 0;">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="24"
                                                     height="24">
                                                    <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="offcanvas-body" style="flex-direction: column; display: flex; gap: 16px;">
                    <div style="font-weight: lighter; display: flex; justify-content: space-between; align-items: center;">
                    <span style="flex: 1;">
                        <span id="quantidade-itens"><?= $totalItens ?></span> SENHAS / TOTAL:
                    </span>
                        <span id="valor-total" style="text-align: right;">
                        <?= Yii::$app->formatter->asCurrency($valorTotal, 'EUR') ?>
                    </span>
                    </div>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                        Checkout
                    </button>
                </div>

                <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="checkoutModalLabel">Dados de pagamento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Por favor, insira os seus dados para proceder ao pagamento.</p>

                                <form id="paymentForm">
                                    <div class="mb-3">
                                        <label for="cardNumber" class="form-label">Número do Cartão</label>
                                        <input type="text" class="form-control" id="cardNumber" placeholder="Insira o número do cartão" maxlength="19" required>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="expirationDate" class="form-label">Validade</label>
                                            <input type="month" class="form-control" id="expirationDate" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="securityCode" class="form-label">Código de Segurança</label>
                                            <input type="text" class="form-control" id="securityCode" placeholder="Código de 3 dígitos" maxlength="3" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="cardHolder" class="form-label">Titular do Cartão</label>
                                        <input type="text" class="form-control" id="cardHolder" placeholder="Nome completo do titular" required>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <a href="<?= \yii\helpers\Url::to(['carrinho/checkout']) ?>" class="btn btn-primary" id="confirmCheckout">Confirmar</a>
                            </div>

                            <div id="loadingAnimation" style="display: none; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p>A processar pagamento...</p>
                            </div>

                            <form id="paymentDataForm" method="post" action="<?= \yii\helpers\Url::to(['carrinho/checkout']) ?>" style="display: none;">
                                <?= \yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                                <input type="hidden" id="hiddenCardNumber" name="cardNumber">
                                <input type="hidden" id="hiddenExpirationDate" name="expirationDate">
                                <input type="hidden" id="hiddenSecurityCode" name="securityCode">
                                <input type="hidden" id="hiddenCardHolder" name="cardHolder">
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('confirmCheckout').addEventListener('click', function(event) {
        event.preventDefault();

        const cardNumber = document.getElementById('cardNumber').value;
        const expirationDate = document.getElementById('expirationDate').value;
        const securityCode = document.getElementById('securityCode').value;
        const cardHolder = document.getElementById('cardHolder').value;

        if (!cardNumber || !expirationDate || !securityCode || !cardHolder) {
            alert("Por favor, preencha todos os campos.");
            return;
        }

        document.getElementById('loadingAnimation').style.display = 'block';
        document.getElementById('confirmCheckout').style.display = 'none';

        const formattedCardNumber = formatCardNumber(cardNumber);
        const formattedExpirationDate = formatExpirationDate(expirationDate);

        document.getElementById('hiddenCardNumber').value = formattedCardNumber;
        document.getElementById('hiddenExpirationDate').value = formattedExpirationDate;
        document.getElementById('hiddenSecurityCode').value = securityCode;
        document.getElementById('hiddenCardHolder').value = cardHolder;

        setTimeout(function() {
            const loadingContainer = document.getElementById('loadingAnimation');
            loadingContainer.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#28a745" class="bi bi-check-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                <path d="M10.97 4.97a.75.75 0 0 1 1.06 1.06L7.477 10.06a.75.75 0 0 1-1.08.02L5.324 8.354a.75.75 0 1 1 1.06-1.06l.94.94 3.646-3.646z"/>
            </svg>
            <p>Pagamento efetuado com sucesso</p>
        `;

            setTimeout(function() {
                document.getElementById('paymentDataForm').submit();
            }, 1500);
        }, 3000);
    });

    function formatCardNumber(cardNumber) {
        return cardNumber.replace(/\D/g, '')
            .replace(/(\d{4})(?=\d)/g, '$1 ');
    }

    function formatExpirationDate(expirationDate) {
        const [year, month] = expirationDate.split('-');
        return `${month}/${year.slice(2)}`;
    }

    document.getElementById('cardNumber').addEventListener('input', function (event) {
        const input = event.target;
        let cardNumber = input.value.replace(/[^0-9]/g, '');
        cardNumber = cardNumber.match(/.{1,4}/g)?.join('-') || '';
        input.value = cardNumber;
    });

</script>




<style>
    .p-5, .jumbotron {
        padding: 1rem !important;
        margin-bottom: 0.5vw;
    }

    .ementa-semana {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 750px;
        margin: 0 auto;
    }

    #loadingAnimation {
        display: none;
        justify-content: center;
        align-items: center;
        text-align: center;
        width: 100%;
        height: 100%;
    }


    .spinner-border {
        width: 3rem;
        height: 3rem;
        border-width: 0.3rem;
        border-top-color: #28a745;
        border-right-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
    }

    #loadingAnimation p {
        margin-top: 10px;
        font-weight: lighter;
        color: #28a745;
    }

    .parent-container {
        position: relative;
        display: flex;
    }

    #loadingAnimation svg {
        margin-bottom: 10px;
        animation: scaleIn 0.5s ease-in-out forwards;
    }

    @keyframes scaleIn {
        from {
            transform: scale(0);
        }
        to {
            transform: scale(1);
        }
    }

    #loadingAnimation p {
        font-weight: lighter;
        color: #28a745;
        margin-top: 10px;
    }

</style>
