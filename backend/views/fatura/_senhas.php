<?php
/** @var array $senhas */

use yii\bootstrap5\Html;

if (empty($senhas)) {
    echo "<tr><td colspan='5' style='text-align: center;'>Nenhuma senha encontrada.</td></tr>";
} else {
    foreach ($senhas as $senha) {
        echo "<tr>";
        echo "<td  style='text-align: center'>" . Html::encode($senha->id) . "</td>";
        echo "<td  style='text-align: center'>1</td>";
        echo "<td  style='text-align: center'>" . Html::encode($senha->valor ? $senha->valor->valor : 'Valor não encontrado') . "</td>";
        echo "<td  style='text-align: center'>" . Html::encode($senha->valor ? $senha->valor->iva : 'IVA não encontrado') . "</td>";

        if ($senha->valor) {
            $valor = $senha->valor->valor;
            $iva = $senha->valor->iva;
            $totalComIva = $valor + ($valor * $iva / 100);
            echo "<td  style='text-align: center'>" . Html::encode(number_format($totalComIva, 2, ',', '.')) . "</td>";
        } else {
            echo "<td>" . Html::encode('Total não disponível') . "</td>";
        }

        echo "</tr>";
    }
}?>
