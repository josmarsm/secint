<?php

include '../funcoes/funcoes.php';
include("../includes/mpdf60/mpdf.php");

global $db;
$sql = 'SELECT * FROM candidato where pagamento_inscricao="Sim" and documentacao="Sim" and nota_curriculo >=5 order by nome';
$result_candidato = $db->prepare($sql);
$result_candidato->execute();
$res_candidato = $result_candidato->fetchAll(PDO::FETCH_ASSOC);

$lista = '';
$total_selecionados = 0;
foreach ($res_candidato as $row) {
    $lista .= $row['inscricao'] . ' - ' . $row['nome'] . '<br>';
    $total_selecionados++;
}

//$mpdf=new mPDF('c','A4','','',32,25,47,47,10,10);
$mpdf = new mPDF(
        'c', // mode - default ''
        '', // format - A4, for example, default ''
        0, // font size - default 0
        '', // default font family
        30, // margin_left
        20, // margin right
        15, // margin top
        15, // margin bottom
        10, // margin header
        10, // margin footer
        'L');  // L - landscape, P - portrait

$header = '
<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
<td width="38%">Processo Seletivo PGCC - Ingresso 2018\1<span style="font-size:14pt;"></span></td>
<td width="33%" align="center"></td>
<td width="33%" style="text-align: right;"><span style="font-weight: bold;">{DATE j-m-Y}</span></td>
</tr></table>
';

$footer = '
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>
<td width="33%">UFSM</td>
<td width="33%" align="center"></td>
<td width="33%" style="text-align: right;"><span style="font-weight: bold;">página {PAGENO} de {nb}</span></td>
</tr></table>
';

$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);


$html = '
<h2 style="margin-collapse: none; margin-top: 2mm; text-align:center;">Etapa 1</h2>
Lista dos candidatos classificados para a Etapa 2 do processo seletivo para ingresso no PGCC 2018\1.<br>
<p>
<b>Nº Inscrição / Nome</b><br>
' . $lista . '
<b>Total de selecionados: ' . $total_selecionados . '</b>
</p>
';

$mpdf->WriteHTML($html);

$mpdf->Output();
exit;
?>