<?php

/** @var yii\web\View $this */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Tabs;
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent">
        <h4 >Bem vindo, <?= Yii::$app->user->identity->username ?>!</h4><br>
    </div>

    <div class="body-content">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'options' => ['class' => 'form-inline', 'id' => 'form-id'],
        ]); ?>

        <?php if (!empty($cozinhas)): ?>
            <?= Tabs::widget([
                'items' => array_map(function ($cozinha) use ($activeCozaId) {
                    return [
                        'label' => $cozinha->designacao,
                        'active' => $cozinha->id == $activeCozaId,
                        'linkOptions' => [
                            'onclick' => "
                                $('#active-coza-id').val({$cozinha->id}); 
                                $('#form-id').submit(); 
                                return false;
                            ",
                        ],
                    ];
                }, $cozinhas),
                'options' => ['class' => 'nav nav-tabs'],
            ]); ?>

            <?= Html::hiddenInput('activeCozaId', $activeCozaId, ['id' => 'active-coza-id']); ?>
        <?php else: ?>
            <p class="text-center">Nenhuma cozinha encontrada.</p>
        <?php endif; ?>
        <?= Html::input('text', 'qrCodeInput', '', [
            'id' => 'qr-code-input',
            'class' => 'form-control',
            'style' => 'opacity: 0;'
        ]); ?>

        <?php ActiveForm::end(); ?>
        <div class="row justify-content-center" style="padding-top: 5vh">
            <div class="col-lg-3 text-center">
                <div class="card" style="border-radius: 10px; background-color: #E9FCFF; border: 1px solid #E9FCFF;">
                    <div class="card-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-12">
                                <p class="card-text text-center" style="color: #2B7BFF; text-decoration: underline"><strong>Menu Principal</strong></p>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-6 text-left">
                                <p class="card-text"><strong>Por servir</strong></p>
                            </div>
                            <div class="col-6 text-center">
                                <div class="rounded bg-white text-black d-flex align-items-center justify-content-center mx-auto" style="width: 2vw; height: 5vh; border: 1.5px solid #E9FCFF;">
                                    <p class="mb-0"><?=$porServirNormal?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-6 text-left">
                                <p class="card-text"><strong>Servidas</strong></p>
                            </div>
                            <div class="col-6 text-center">
                                <div class="rounded bg-white text-black d-flex align-items-center justify-content-center mx-auto" style="width: 2vw; height: 5vh; border: 1.5px solid #E9FCFF;">
                                    <p class="mb-0"><?=$servidasNormal?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 text-center">
                <div class="card" style="border-radius: 10px; background-color: #D9FBE7; border: 1px solid #E9FCFF;">
                    <div class="card-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-12">
                                <p class="card-text text-center" style="color: #2BC194; text-decoration: underline"><strong>Menu Vegetariano</strong></p>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-6 text-left">
                                <p class="card-text"><strong>Por servir</strong></p>
                            </div>
                            <div class="col-6 text-center">
                                <div class="rounded bg-white text-black d-flex align-items-center justify-content-center mx-auto" style="width: 2vw; height: 5vh; border: 1.5px solid #E9FCFF;">
                                    <p class="mb-0"><?=$porServirVegetariano?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-6 text-left">
                                <p class="card-text"><strong>Servidas</strong></p>
                            </div>
                            <div class="col-6 text-center">
                                <div class="rounded bg-white text-black d-flex align-items-center justify-content-center mx-auto" style="width: 2vw; height: 5vh; border: 1.5px solid #E9FCFF;">
                                    <p class="mb-0"><?=$servidasVegetariano?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 text-center">
                <div class="card" style="border-radius: 10px; background-color: #F6F6F6; border: 1px solid #E9FCFF;">
                    <div class="card-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-12">
                                <p class="card-text text-center" style="color: #7D9598; text-decoration: underline"><strong>Total</strong></p>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-6 text-left">
                                <p class="card-text"><strong>Por servir</strong></p>
                            </div>
                            <div class="col-6 text-center">
                                <div class="rounded bg-white text-black d-flex align-items-center justify-content-center mx-auto" style="width: 2vw; height: 5vh; border: 1.5px solid #E9FCFF;">
                                    <p class="mb-0"><?=$porServirTotal?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-6 text-left">
                                <p class="card-text"><strong>Servidas</strong></p>
                            </div>
                            <div class="col-6 text-center">
                                <div class="rounded bg-white text-black d-flex align-items-center justify-content-center mx-auto" style="width: 2vw; height: 5vh; border: 1.5px solid #E9FCFF;">
                                    <p class="mb-0"><?=$servidasTotal?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="user-id-container" style="display:none; margin-top: 20px;">
        <p>User ID da Reserva: <span id="user-id"></span></p>
    </div>

</div>

<script>

    function atualizarReserva(idReserva) {
        fetch('<?= \yii\helpers\Url::to(['site/update-reserva']) ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
            },
            body: JSON.stringify({ id: idReserva })
        })

            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('user-id').textContent = data.user_id;
                    document.getElementById('user-id-container').style.display = 'block';
                } else {
                    alert(data.message || 'Erro ao atualizar a reserva.');
                }
            })
            .catch(error => console.error('Erro ao atualizar a reserva:', error));
    }

    document.getElementById('qr-code-input').addEventListener('input', function() {
        const base64Data = this.value;
        console.log('Valor recebido do input:', base64Data);

        if (!base64Data) {
            console.error('O campo de input está vazio.');
            return;
        }

        try {
            const jsonString = atob(base64Data);
            console.log('Valor decodificado:', jsonString);

            const data = JSON.parse(jsonString);
            const idReserva = data.id;
            console.log('ID da reserva:', idReserva);
            atualizarReserva(idReserva);
        } catch (e) {
            console.error('Erro ao decodificar ou processar o JSON:', e);
        }
    });

    document.getElementById('qr-code-input').addEventListener('blur', function() {
        this.dispatchEvent(new Event('input'));
    });

    setInterval(function() {
        const qrInput = document.getElementById('qr-code-input');
        qrInput.focus();
        qrInput.select();
    }, 1000);
</script>