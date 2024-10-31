<?php
/** @var array $senhas */
use yii\bootstrap5\Html;

$totalValor = 0;
$totalSemIva = 0;
$totalIva = 0;

if (empty($senhas)) {
    echo "<tr><td colspan='5' style='text-align: center;'>Sem senhas por pagar.</td></tr>";
} else {
    foreach ($senhas as $senha) {
        echo "<tr>";
        echo "<td style='text-align: center'>" . Html::encode($senha->id) . "</td>";
        echo "<td style='text-align: center'>1</td>";
        echo "<td class='valor' style='text-align: center'>" . Html::encode($senha->valor ? number_format($senha->valor->valor, 2, ',', '.') : 'Valor não encontrado') . "</td>";
        echo "<td class='iva' style='text-align: center'>" . Html::encode($senha->valor ? number_format($senha->valor->iva , 2, ',', '.') : 'IVA não encontrado') . "</td>";

        echo "<input type='hidden' name='senhas[{$senha->id}][id]' value='" . Html::encode($senha->id) . "'>";
        echo "<input type='hidden' name='senhas[{$senha->id}][quantidade]' value='1'>";
        echo "<input type='hidden' name='senhas[{$senha->id}][preco_sem_iva]' value='" . $senha->valor->valor . "'>";
        echo "<input type='hidden' name='senhas[{$senha->id}][taxa_iva]' value='" . $senha->valor->iva . "%'>";

        if ($senha->valor) {
            $valor = $senha->valor->valor;
            $iva = $senha->valor->iva;
            $totalComIva = $valor + ($valor * $iva / 100);
            echo "<td style='text-align: center'>" . Html::encode(number_format($totalComIva, 2, ',', '.')) . "</td>";

            $totalValor += $totalComIva;
            $totalSemIva += $valor;
            $totalIva += ($valor * $iva / 100);
        } else {
            echo "<td>" . Html::encode('Total não disponível') . "</td>";
        }

        echo "</tr>";
    }
}
?>
