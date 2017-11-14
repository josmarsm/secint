<?php

// include Database connection file
include("config.php");

// check request
if (isset($_POST['id_identificacao']) && isset($_POST['id_identificacao']) != "") {
// get User ID
    $id_identificacao = $_POST['id_identificacao'];
    
// Get User Details
    $statement = $db->prepare("SELECT * FROM identificacao where id_identificacao =$id_identificacao");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    //$query = "SELECT * FROM users WHERE id = '$user_id'";
//if (!$result = mysqli_query($con, $query)) {
//  exit(mysqli_error($con));
//}
    $response = array();
    if (count($result) > 0) {
        foreach ($result as $row) {
            $response = $row;
        }
    } else {
        $response['status'] = 200;
        $response['message'] = "Data not found!";
    }
// display JSON data
    echo json_encode($response);
} else {
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}