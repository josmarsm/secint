<?php

include '../funcoes/funcoes.php';
include("../includes/mpdf60/mpdf.php");

global $db;
$sql_geral = 'select
count(id_candidato) as total_candidatos,
SUM(CASE WHEN pagamento_inscricao="Sim" THEN 1 ELSE 0 END) AS pagamento_inscricao,
SUM(CASE WHEN documentacao = "Sim" THEN 1 ELSE 0 END) AS enviaram_documentacao,
SUM(CASE WHEN documentacao = "Não" THEN 1 ELSE 0 END) AS nao_enviaram_documentacao,
SUM(CASE WHEN documentacao = "Sim" and pagamento_inscricao = "Não" THEN 1 ELSE 0 END) AS documentacao_sem_inscricao,
SUM(CASE WHEN pagamento_inscricao = "Sim" and documentacao = "Sim" THEN 1 ELSE 0 END) AS aptos_avaliacao
FROM
candidato';
$select_geral = $db->query($sql_geral);
$result_geral = $select_geral->fetch(PDO::FETCH_ASSOC);


$sql_etapa1 = 'select
SUM(CASE WHEN nota_curriculo >=5 THEN 1 ELSE 0 END) AS classificados_etapa1,
SUM(CASE WHEN nota_curriculo <5 THEN 1 ELSE 0 END) AS nao_classificados_etapa1
FROM
candidato
where pagamento_inscricao="Sim" and documentacao="Sim"';
$select_etapa1 = $db->query($sql_etapa1);
$result_etapa1 = $select_etapa1->fetch(PDO::FETCH_ASSOC);
//$lista = '';
//$total_selecionados = 0;
//foreach ($res_candidato as $row) {
//    $lista .= $row['inscricao'] . ' - ' . $row['nome'] . '<br>';
//    $total_selecionados++;
//}

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
<h2 style="margin-collapse: none; margin-top: 2mm; text-align:center;">Quadro estatístico</h2>
<p>
Número total de candidatos: '. $result_geral['total_candidatos'] . ' <br>
Pagaram inscrição: '. $result_geral['pagamento_inscricao'] . ' <br>
Enviaram documentação: '. $result_geral['enviaram_documentacao'] . ' <br>
Não enviaram documentação: '. $result_geral['nao_enviaram_documentacao'] . ' <br>
Enviaram documentação sem pagar taxa de inscrição: '. $result_geral['documentacao_sem_inscricao'] . ' <br>
Aptos á avaliação: '. $result_geral['aptos_avaliacao'] . ' <br>
</p>
<p>
Etapa 1<br>
Classificados: '. $result_etapa1['classificados_etapa1'] .'<br>
Não Classificados: '. $result_etapa1['nao_classificados_etapa1'] .'<br>
</p>
<p>
Etapa 2<br>
Classificados:  <br>
Não Classificados:  <br>
</p>
';

$mpdf->WriteHTML($html);

$mpdf->Output();
exit;
?>