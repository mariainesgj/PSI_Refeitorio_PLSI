<?php

use app\models\Ementa;
use yii\bootstrap5\Tabs;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider[] $dataProviders */
/** @var app\models\EmentaSearch $searchModel */
/** @var array $cozinhas - array de cozinhas com id e nome */

$this->title = 'Ementas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cozinha-index">
    <div class="container mt-4 align">
        <div class="row align-items-center mb-4">
            <div class="col-auto  me-auto">
                <h3 class="mb-0" style="color: #979797;">Ementas</h3>
            </div>
            <div class="col-auto">
                <?= Html::beginForm(['ementa/index'], 'get', ['class' => 'input-group']) ?>
                <?= Html::textInput('EmentaSearch[data]', $searchModel->data, [
                    'class' => 'form-control',
                    'placeholder' => 'Data',
                    'type' => 'date',
                    'style' => 'border-radius: 7px;'
                ]) ?>
                <div class="input-group-append">
                    <?= Html::submitButton('Pesquisar', [
                        'class' => 'btn btn-primary ml-2',
                        'id' => 'btn-pesquisar',
                        'style' => 'margin-left: 10px;'
                    ]) ?>
                </div>
                <?= Html::endForm() ?>
            </div>
        </div>

        <?php if (!empty($cozinhas)): ?>
            <?= Tabs::widget([
                'items' => array_map(function($cozinha) use ($dataProviders, $activeCozaId, $weekDays, $menus, $pratos) {
                    $menuContent = '<div class="blue-containers-row d-flex justify-content-around mt-4">';

                    foreach ($weekDays as $day) {
                        $menu = $menus[$cozinha->id][$day] ?? null;

                        $menuContent .= '<div class="blue-container">';
                        $menuContent .= '<span class="text-line" style="text-decoration: underline;">' . Yii::$app->formatter->asDate($day, 'php:D, d M Y') . '</span>';

                        if ($menu !== null) {
                            $menuContent .= '<span class="text-line">Sopa: ' . Html::encode($pratos[$menu->sopa]->designacao ?? 'N/A') . '</span>';
                            $menuContent .= '<span class="text-line">Menu Principal: ' . Html::encode($pratos[$menu->prato_normal]->designacao ?? 'N/A') . '</span>';
                            $menuContent .= '<span class="text-line">Menu Vegetariano: ' . Html::encode($pratos[$menu->prato_vegetariano]->designacao ?? 'N/A') . '</span>';
                        } else {
                            $menuContent .= '<span class="text-line">Menu não encontrado</span>';
                        }

                        $menuContent .= '</div>';
                    }

                    $menuContent .= '</div>';

                    return [
                        'label' => Html::encode($cozinha->designacao),
                        'content' => $menuContent,
                        'active' => $cozinha->id == $activeCozaId,
                    ];
                }, $cozinhas),
            ]); ?>
        <?php else: ?>
            <p class="text-center">Nenhuma cozinha encontrada.</p>
        <?php endif; ?>

        <p class="text-center">
            <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-primary ml-2']) ?>
        </p>

    </div>


<style>
    .cozinha-index {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .rounded-table {
        border-radius: 10px;
        overflow: hidden;
    }

    .rounded-table th, .rounded-table td {
        border: none;
        padding: 10px;
    }

    .rounded-table th {
        background-color: #ffffff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .rounded-table tr {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .blue-containers-row {
        gap: 10px;
        padding-bottom: 20px;
    }

    .blue-container {
        background-color: #3b99ff;
        color: white;
        width: 50vw;
        min-height: 20vh;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        flex-direction: column;
        padding: 10px;
        overflow-wrap: break-word;
    }

    .text-line {
        font-size: 1.75vh;
        text-align: center;
        margin: 5px 0;
    }
</style>
