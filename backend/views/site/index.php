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
            'style' => 'opacity: 0;', //1 para ficar visivel ao user
            'autocomplete' => 'off',
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

    <div class="senhas-list" style="margin-top: 30px">
        <?php if (!empty($senhas)): ?>
            <div class="list-group">
                <?php foreach ($senhas as $senha): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center"
                         style="box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); margin-bottom: 10px; border-radius: 10px; background-color: #f8f9fa; min-height: 80px;">
                        <div>
                            <?= Yii::$app->formatter->asDatetime($senha->lido, 'php:H:i:s') ?>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <a><?= Html::encode($senha->user->profile->name ?? 'N/A') ?></a>
                            <a style="font-size: 14px; color: #8e8e8e"><?= Html::encode(ucfirst($senha->user->profile->role ?? 'N/A')) ?></a>
                        </div>
                        <div>
                            <?php if ($senha->prato->tipo === 'prato normal'): ?>
                                <img src="<?= Yii::getAlias('@web/images/menu_principal.png') ?>" alt="Menu Principal" class="img-fluid" style="width: 10vw">
                            <?php elseif ($senha->prato->tipo === 'prato vegetariano'): ?>
                                <img src="<?= Yii::getAlias('@web/images/menu_salada.png') ?>" alt="Menu Vegetariano" class="img-fluid" style="width: 10vw">
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center">
                <img src="<?= Yii::getAlias('@web/images/sem_senhas.png') ?>" alt="Sem senhas" class="img-fluid" style="width: 19vw">
                <?php
                $cozinhaAtiva = null;
                foreach ($cozinhas as $cozinha) {
                    if ($cozinha->id == $activeCozaId) {
                        $cozinhaAtiva = $cozinha;
                        break;
                    }
                } ?>
                <p style="font-size: 15px; color: #8e8e8e">Ainda sem refeições servidas hoje para o <?= $cozinhaAtiva ? Html::encode($cozinhaAtiva->designacao) : 'cozinha desconhecida' ?>. Beba um café enquanto espera.</p>
            </div>
        <?php endif; ?>
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

                    document.getElementById('user-id-container').style.display = 'block';
                    const urlParams = new URLSearchParams(window.location.search);
                    const activeCozaId = urlParams.get('activeCozaId') || '';
                    window.location.href = `?activeCozaId=${activeCozaId}&qrCodeInput=`;
                } else {
                    alert(data.message || 'Erro ao atualizar a reserva.');
                }
            })
            .catch(error => console.error('Erro ao atualizar a reserva:', error));
    }

    document.getElementById('qr-code-input').addEventListener('input', function() {
        const rawValue = this.value;
        console.log('Valor original:', rawValue);

        const valorTransformado = substituirCaracteres(rawValue);
        console.log('Valor transformado:', valorTransformado);

        if (!isBase64(valorTransformado)) {
            console.error('O valor não é uma string Base64 válida:', valorTransformado);
            //return;
        }

        try {
            const jsonString = atob(valorTransformado);
            console.log('Valor decodificado:', jsonString);

            const data = JSON.parse(jsonString);
            const idReserva = data.id;
            console.log('ID da reserva:', idReserva);
            atualizarReserva(idReserva);
        } catch (e) {
            console.error('Erro ao processar a string JSON:', e);
        }
    });

    setInterval(function() {
        const qrInput = document.getElementById('qr-code-input');
        qrInput.focus();
        qrInput.select();
    }, 1000);

    function substituirCaracteres(input) {
        let result = input.replace(/««/g, '==').replace(/«/g, '=');
        console.log('Após substituir caracteres inválidos:', result);
        return result;
    }


    function isBase64(str) {
        try {
            if (str === '' || typeof str !== 'string') {
                return false;
            }
            return btoa(atob(str)) === str.replace(/=/g, '');
        } catch (e) {
            return false;
        }
    }
</script>
