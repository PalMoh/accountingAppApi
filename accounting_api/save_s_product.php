<?php

/* 
 * create by Mohammad 
 * 7/11/2018
 * by HP
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['idsbill'])    &&
    isset($_POST['p_name'])     &&
    isset($_POST['p_pur'])      &&
    isset($_POST['p_sell'])     &&    
    isset($_POST['p_qu'])       &&
    isset($_POST['total'])         
    ){
    
    $idsbill    = $_POST['idsbill'];
    $p_name     = $_POST['p_name'];
    $p_pur      = $_POST['p_pur'];
    $p_sell     = $_POST['p_sell'];
    $p_qu       = $_POST['p_qu'];
    $total      = $_POST['total'];

    
    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql inserting a new row
    $result = mysqli_query($db->_connect(),"INSERT INTO b_product(idsbill,p_name,p_pur,p_sell,p_qu,total) VALUES('$idsbill', '$p_name','$p_pur','$p_sell',$p_qu,'$total')");

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Product saved successfully.";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
        
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}


