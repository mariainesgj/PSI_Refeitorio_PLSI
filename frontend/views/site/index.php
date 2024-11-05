<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <?php use yii\helpers\Html;
            use yii\helpers\Url;

            if (!Yii::$app->user->isGuest) { ?>
                <div class="jumbotron text-center bg-transparent">
                    <h4>Bem vindo/a, <?= Html::encode($userName) ?>!</h4><br>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="body-content">
        <div class="ementa-semana">
            <div class="container mt-4">
                <?php
                $previousWeek = (new \DateTime($currentWeekStart))->modify('-7 days')->format('Y-m-d');
                $nextWeek = (new \DateTime($currentWeekStart))->modify('+7 days')->format('Y-m-d');
                ?>

                <div class="navigation-row d-flex justify-content-between align-items-center mt-4">

                    <div class="arrow-left">
                        <a href="<?= Url::to(['site/index', 'week_start' => $previousWeek]) ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3b99ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="15" y1="18" x2="9" y2="12"></line>
                                <line x1="15" y1="6" x2="9" y2="12"></line>
                            </svg>
                        </a>
                    </div>

                    <div class="blue-containers-row d-flex justify-content-around flex-grow-1 mx-2">
                        <?php foreach ($weekDays as $day): ?>
                            <?php $menu = $menus[$day] ?? null; ?>
                            <div class="blue-container">
                                <span class="text-line date-line" style="text-decoration: underline;">
                                    <?= Yii::$app->formatter->asDate($day, 'php:D, d M Y') ?>
                                </span>

                                <?php if ($menu !== null): ?>
                                    <?= Html::a(
                                        '<p class="text-line dish-line">Sopa: ' . Html::encode($pratos[$menu->sopa]->designacao ?? 'N/A') . '</p>' .
                                        '<p class="text-line dish-line">Menu Principal: ' . Html::encode($pratos[$menu->prato_normal]->designacao ?? 'N/A') . '</p>' .
                                        '<p class="text-line dish-line">Menu Vegetariano: ' . Html::encode($pratos[$menu->prato_vegetariano]->designacao ?? 'N/A') . '</p>',
                                        ['ementa/view', 'id' => $menu->id],
                                        ['class' => 'menu-link', 'style' => 'color: white; text-decoration: none;']
                                    ) ?>
                                <?php else: ?>
                                    <div class="date-line">
                                        <img src="<?= Yii::getAlias('@web/images/relogio.png') ?>" alt="Imagem ilustrativa" class="img-fluid" style="width: 7vw"><br>
                                        <span>Ainda sem ementa</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="arrow-right">
                        <a href="<?= Url::to(['site/index', 'week_start' => $nextWeek]) ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3b99ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="9" y1="6" x2="15" y2="12"></line>
                                <line x1="9" y1="18" x2="15" y2="12"></line>
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .ementa-semana {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navigation-row {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .blue-containers-row {
            gap: 10px;
            padding-bottom: 20px;
            align-items: center;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .blue-container {
            background-color: #3b99ff;
            color: white;
            width: 12.5vw;
            min-height: 27vh;
            display: flex;
            align-items: start;
            justify-content: start;
            border-radius: 5px;
            flex-direction: column;
            padding: 10px;
            overflow-wrap: break-word;
        }

        .text-line {
            font-size: 1.75vh;
            margin: 5px 0;
        }

        .date-line {
            text-align: center;
            width: 100%;
        }

        .dish-line {
            text-align: left;
            padding-left: 10px;
        }

        .arrow-left, .arrow-right {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</div>
