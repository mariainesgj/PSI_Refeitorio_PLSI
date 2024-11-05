<?php
use yii\helpers\Html;

$this->title = 'As minhas faturas';
?>

<div class="invoice-index">

    <div style="background-color: #f8f9fa; border-radius: 5px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); ">
        <h3 style="color:#979797;"><?= Html::encode($this->title) ?></h3>

        <?php if (!empty($faturas)): ?>
            <?php foreach ($faturas as $fatura): ?>
                <div style="text-align: center; border: 1px solid #dee2e6; border-radius: 10px; margin: 10px auto; padding: 15px; background-color: #ffffff; display: flex; align-items: center; justify-content: space-between; width: 35vw;">
                    <div style="flex: 1;">
                        <strong># <?= Html::encode($fatura->id) ?></strong>
                    </div>
                    <div style="text-align: center; flex: 1;">
                        Valor Pago: <?= Html::encode($fatura->total_doc) ?>€
                    </div>
                    <div style="flex: 1; text-align: right;">
                        <?= Html::a('Visualizar', ['view', 'id' => $fatura->id], ['class' => 'btn btn-info btn-sm']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhuma fatura encontrada.</p>
        <?php endif; ?>
    </div>

</div>
