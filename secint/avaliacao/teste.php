<?php


$html = '
    

<pageheader name="myHeaderNoNum" content-left="Seleção PGCC 2018" content-center="Avaliação do Curriculo" content-right="" header-style="font-family:sans-serif; font-size:8pt; color:#880000;" header-style-right="font-size:12pt; font-weight:bold; font-style:italic; color:#088000;" line="on" />

<setpageheader name="myHeaderNoNum" page="O" value="on" show-this-page="1" />
<setpageheader name="myHeaderNoNumEven" page="E" value="on" />
<b>Nome: </b> André Gomes Alves<br>
<b>Linhas: </b> Computação Aplicada e Linguagens de Progamação e Banco de Dados<br>
<b>Orientadores </b> Alencar Machado, Eduardo Kessler Piveta e Roseclea Duarte Medina<br>
<b>Poscomp: </b> Sim [2016 - 22 pontos] ou Não<br>
<b>Bolsa: </b> Sim ou Não<br>

<table style="border: 1px solid black">    
        <tr style="border: 1px solid #880000;">
            <th>CRITÉRIOS</th>
            <th width="12%">NOTA</th>
            <th>Pontuação Solicitada</th>
            <th>Nº do Comprovante </th>
            <th>Pontuação Considerada</th>            
        </tr>    
        <tr>
            <td colspan="5">
                <b>1. Formação Acadêmica</b> (máximo 4,0 pontos)
            </td>
        </tr>
        <tr>            
            <td>
                Especialização na área com duração mínima de 360 horas
            </td>
            <td>
                2,5 por curso
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>            
            <td>
                Especialização/Mestrado em área afim com duração mínima de 360 horas
            </td>
            <td>
                2,0 por curso  
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>            
            <td>
                Participação em Projetos de  Pesquisa com bolsa (com carga horária mínima de 240 horas no semestre)
            </td>
            <td>
                0,8 por semestre
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>            
            <td>
                Participação em Projetos de Pesquisa sem bolsa (com carga horária mínima de 240 horas no semestre)
            </td>
            <td>
                0,5 por semestre
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>            
            <td>
                articipação em Projetos de Ensino ou Extensão (com carga horária mínima de 60 horas no semestre)
            </td>
            <td>
                0,2 por semestre
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr >
            <td colspan="5">
                <b>2. Atividades Profissionais e Participação em eventos</b> (na área de computação) (máximo 2,0 pontos)
            </td>
        </tr>
        <tr>            
            <td>
                Atividades docentes (após a graduação)
            </td>
            <td>
               0,5 por semestre
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>            
            <td>
                Atividades profissionais (após a graduação)
            </td>
            <td>
                0,4 por semestre
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>            
            <td>
                Estágio ou participação em empresa júnior
            </td>
            <td>
                0,25 por semestre
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>            
            <td>
                Participação em evento na condição de organizador
            </td>
            <td>
                0,5 por evento
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>            
            <td>
                Participação em evento na condição de palestrante
            </td>
            <td>
                1,0 por evento
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>            
            <td>
                Participação em evento na condição de ouvinte
            </td>
            <td>
                0,1 por evento
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <b>3. Publicação (na área de computação)</b> (máximo 4,0) 
            </td>
        </tr>
        <tr>            
            <td>
                Em âmbito internacional
            </td>
            <td>
                4,0 por pub.
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>            
            <td>
                Em âmbito nacional
            </td>
            <td>
                2,0 por pub. 
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>            
            <td>
                Em âmbito regional
            </td>
            <td>
                1,0 por pub. 
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>            
            <td>
                Resumo
            </td>
            <td>
                0,5 por pub. 
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td align="right" colspan="4">
                <b>Total</b> 
            </td>
            <td align="center">
                <b>55</b> 
            </td>
        </tr>
    </tbody>
</table>



';

//==============================================================
//==============================================================
//==============================================================
include("../includes/mpdf60/mpdf.php");
$stylesheet = "table{
  width: 100%;
  text-align:center;
  border: 2px solid black;
}";
$mpdf=new mPDF('c'); 

$mpdf->mirrorMargins = true;

$mpdf->SetDisplayMode('fullpage','two');
//$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html);

$mpdf->Output();
exit;
//==============================================================
//==============================================================
//==============================================================
//==============================================================
//==============================================================


?>