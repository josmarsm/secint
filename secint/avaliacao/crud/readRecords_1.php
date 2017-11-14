<?php

// include Database connection file 
include("config.php");
session_start();

// Design initial table header 
$data = '<table  
       class="table table-striped table-bordered table-hover" 
       id="dataTables-example">
       <thead>
						<tr>
                                                        <th align=center style="width: 10px">Inscrição</th>
							<th align=center style="width: 200px">Nome</th>
							<th align=center style="width: 180px">Status</th>
							<th align=center style="width: 180px">Situação</th>
							<th align=center style="width: 85px">Delegar</th>
							<th align=center style="width: 100px">Upload Docs</th>
						</tr>
                                                </thead>';

//$query = "SELECT * FROM identificacao";
$avaliador = $_SESSION['id_usuario'];

$statement = $db->prepare('SELECT * FROM candidato where comissao_avaliador ='.$avaliador);
$statement->execute();
$result = $statement->fetchAll();

//print_r($result);
//if (!$result = mysqli_query($coin, $query)) {
//  exit(mysqli_error($con));
//}
// if query results contains rows then featch those rows 
//print_r(count($result));

if (count($result) > 0) {
    $number = 1;
    foreach ($result as $row) {

        if ($row['status'] == 1) {
            $status = "Avaliado - Reavaliar";
        } else {
            $status = 'Não Avaliado - 
                            <a 
                                onclick="GetIdentificacaoDetails(' . $row['id_identificacao'] . ' ) " 
                                class="btn btn-primary">
                                Avaliar
                            </a>';
        }

        if ($row['status'] == 1) {
            $situacao = "Faz calculo para verificar situação";
        } else {
            $situacao = 'Não Avaliado';
        }


        if ($col['status'] == 1) {
            $delegar = "";
        } else {
            $delegar = '<button '
                    . 'onclick="GetCandidatoDelegar(' . $row['id_identificacao'] . ' ) " '
                    . 'class="btn btn-warning">Delegar</button>';
        }
        $data .= '<tr>
			<td>' . $number . '</td>
			<td>' . $row['nome'] . '</td>
			<td>' . $status . ' </td>
			<td>' . $situacao . '</td>
			<td>
                            <button 
                                onclick="GetUserDetails(' . $row['id_usuario'] . ')" 
                                class="btn btn-warning">
                                Update
                            </button>
			</td>
			<td>
                            <button 
                                onclick="DeleteUser(' . $row['id_usuario'] . ')" 
                                class="btn btn-danger">
                                Delete
                                </button>
			</td>	
    		</tr>';
        $number++;
    }
} else {
    $data .= '<tr><td colspan="6">Records not found!</td></tr>';
}

$data .= '</table>';

echo $data;
?>