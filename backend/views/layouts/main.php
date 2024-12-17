<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/cr-2.0.4/r-3.0.3/sl-2.1.0/datatables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/cr-2.0.4/r-3.0.3/sl-2.1.0/datatables.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

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
    $isAdmin = Yii::$app->authManager->getRolesByUser($userId) && in_array('administrador', array_keys(Yii::$app->authManager->getRolesByUser($userId)));
    $isFuncionario = Yii::$app->authManager->getRolesByUser($userId) && in_array('funcionario', array_keys(Yii::$app->authManager->getRolesByUser($userId)));

    $menuItems = [];

    if ($isAdmin) {
        $menuItems = [
            ['label' => 'Ementas', 'url' => ['/ementa/index']],
            ['label' => 'Senhas', 'url' => ['/senha/index']],
            ['label' => 'Faturas', 'items' => [
                ['label' => 'Consultar Faturas', 'url' => ['/fatura/index']],
                ['label' => 'Consultar Movimentos', 'url' => ['/movimento/index']],
            ]],
            ['label' => 'Pratos', 'url' => ['/prato/index']],
            ['label' => 'Cozinhas', 'url' => ['/cozinha/index']],
            ['label' => 'Preçário', 'url' => ['/valor/update']],
            ['label' => 'Utilizadores', 'url' => ['/user/index']],
            ['label' => 'Os meus dados', 'url' => ['/profile/view', 'user_id' => $userId]],
        ];
    } elseif ($isFuncionario) {
        $menuItems = [
            ['label' => 'Ementas', 'url' => ['/ementa/index']],
            ['label' => 'Senhas', 'url' => ['/senha/index']],
            ['label' => 'Pratos', 'url' => ['/prato/index']],
            ['label' => 'Cozinhas', 'url' => ['/cozinha/index']],
            ['label' => 'Utilizadores', 'url' => ['/user/index']],
            ['label' => 'Os meus dados', 'url' => ['/profile/view', 'user_id' => $userId]],
        ];
    }

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none', 'style' => 'color: white;']
            )
            . Html::endForm();
    }
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
<?php $this->endPage();
