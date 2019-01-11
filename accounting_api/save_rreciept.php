<?php

/* 
 * create by Mohammad 
 * 8/11/2018
 * by HP
 * save payment سند صرف
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['idcus'])    &&
    isset($_POST['dtcus'])    &&
    isset($_POST['ftofl'])    &&
    isset($_POST['psums'])    &&
    isset($_POST['descn'])    &&    
    isset($_POST['tsums'])    &&     
    isset($_POST['notes'])){
    
    $idcus    = $_POST['idcus'];
    $dtcus    = $_POST['dtcus'];
    $ftofl    = $_POST['ftofl'];
    $psums    = $_POST['psums'];
    $descn    = $_POST['descn'];
    $tsums    = $_POST['tsums'];
    $notes    = $_POST['notes'];   
    
   
    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql inserting a new row
    $result = mysqli_query($db->_connect()," INSERT INTO pay_in (idcus, dtcus, ftofl, psums, descn, tsums, notes) VALUES ('$idcus','$dtcus','$ftofl','$psums', '$descn','$tsums','$notes')");
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Payment successfully created.";

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


