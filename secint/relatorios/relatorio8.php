<?php

include '../funcoes/funcoes.php';
include("../includes/mpdf60/mpdf.php");

global $db;
$sql_avaliador = 'select u.id_usuario as id_avaliador, u.nome as nome_avaliador FROM usuario u INNER JOIN candidato c ON u.id_usuario = c.comissao_avaliador
GROUP BY u.id_usuario';
$select_avaliador = $db->query($sql_avaliador);
$result_avaliador = $select_avaliador->fetchAll(PDO::FETCH_ASSOC);

foreach ($result_avaliador as $avaliador) {
    $id_avaliador = $avaliador['id_avaliador'];
    $avaliador = $avaliador['nome_avaliador'];
    $sql_candidato = 'select c.nome as nome_candidato, c.inscricao as inscricao, 
        c.pagamento_inscricao as pagamento_inscricao, c.documentacao as documentacao
FROM candidato c
INNER JOIN usuario ON usuario.id_usuario = c.comissao_avaliador 
where c.comissao_avaliador =' . $id_avaliador . ' order by nome_candidato';
    $select_candidato = $db->query($sql_candidato);
    $result_candidato = $select_candidato->fetchAll(PDO::FETCH_ASSOC);
    $lista .= '<h3>' . $avaliador . '</h3>';
    $lista .= '<table class="table table-striped">
        <thead>
        <tr>
        <th>#</th>
        <th width="90">Nº inscrição</th>
        <th width="300">Nome</th>
        <th width="120">Pagou inscrição</th>
        <th width="130">Entregou envelope</th>
        </tr>
        </thead>';    
    $lista_candidatos = '';
    $ordem = 0;
    foreach ($result_candidato as $candidato) {
        $ordem++;
        //$candidato = $candidato['nome_candidato'];
        //$lista_candidatos .= $candidato . '<br>';
                $lista_candidatos .= '        
        <tbody>
        <tr>
        <th scope = "row">'.$ordem.'</th>
        <td width="90">'.$candidato['inscricao'].'</td>
        <td width="300">'.$candidato['nome_candidato'].'</td>
        <td width="120">'.$candidato['pagamento_inscricao'].'</td>
        <td width="130">'.$candidato['documentacao'].'</td>
        </tr>                
        </tbody>'; 
        
    }
    $lista .= $lista_candidatos;
    $lista .= '</table>';
}


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
<h2 style="margin-collapse: none; margin-top: 2mm; text-align:center;">Candidatos Por Avaliador - Comissão de Seleção</h2>
<p>
' . $lista . '

</p>
';

$mpdf->WriteHTML($html);

$mpdf->Output();
exit;
?>