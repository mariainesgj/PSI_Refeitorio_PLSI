<?php

/** @var \yii\web\View $this */

/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-primary fixed-top'
        ],
    ]);

    $userId = Yii::$app->user->id;

    $menuItems = [];

    if (!Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Página Inicial', 'url' => ['/site/index']];
        $menuItems[] = [
            'label' => 'Faturas',
            'items' => [
                ['label' => 'Consultar Faturas', 'url' => ['/fatura/index']],
                ['label' => 'Consultar Movimentos', 'url' => ['/movimento/index']],
            ],
        ];
        $menuItems[] = ['label' => 'Os meus dados', 'url' => ['/profile/view', 'user_id' => $userId]];
    }

    /*if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Criar conta', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    }*/

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);

    if (Yii::$app->user->isGuest) {
        echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Html::encode(Yii::$app->user->identity->username) . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    } ?>
    <div class="d-flex">
        <button id="btn-card" class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            <svg xmlns="http://www.w3.org/2000/svg" style="height: 3.5vh;" viewBox="0 0 576 512">
                <path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"
                      fill="white"/>
            </svg>
        </button>
    </div>
    <?php
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>


        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header" style="flex-direction: column;">
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrinho de compras</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                <div id="card-itens" class="col-12" style="flex-direction: column; display: flex; gap: 16px;">

                </div>
            </div>
            <div class="offcanvas-body" style="flex-direction: column; display: flex; gap: 16px;">
                <div style="font-weight: lighter; display: flex; justify-content: space-between; align-items: center;">
        <span style="flex: 1;">
            <span id="quantidade-itens"></span> / TOTAL:
        </span>
                    <span id="valor-total" style="text-align: right;"></span>
                </div>
                <div id="checkout-btn" style="width: 100%; display: none;">
                    <?= Html::a('Checkout', ['carrinho/index'], ['class' => 'btn btn-primary w-100']) ?>
                </div>
            </div>

        </div>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>


<script>
    $(function () {
        $('#btn-card').click(function () {
            $('#card-itens').html(`
            <div>A carregar o carrinho...</div>
        `);
            $.ajax({
                url: '<?= \yii\helpers\Url::to('?r=carrinho/listar-carrinho') ?>',
                dataType: 'json', //garante que a repsosta é tratada como JSON
                success: function (response) {
                    if (Array.isArray(response)) {
                        var cardContent = $('#card-itens');
                        cardContent.html('');
                        var quantidadeItens = response.length;
                        //console.log("Quantidade de itens:", quantidadeItens);
                        $('#quantidade-itens').html(`${quantidadeItens} senha(s)`);

                        response.forEach(function (item) {
                            if (item.html) {
                                cardContent.append(item.html);
                            }
                        });

                        var valorTotal = response.reduce(function (total, item) {
                            return total + parseFloat(item.valor);
                        }, 0);

                        $('#valor-total').html(
                            `${valorTotal.toFixed(2)}€`
                        );

                        if (quantidadeItens >= 1) {
                            $('#checkout-btn').show();
                        } else {
                            $('#checkout-btn').hide();
                        }

                    } else {
                        $('#card-itens').html('<div>Erro: resposta não é um array válido.</div>');
                    }
                },
                error: function () {
                    $('#card-itens').html(`
                    <div>Carrinho vazio</div>
                `);
                }
            });
        });
    });

</script>