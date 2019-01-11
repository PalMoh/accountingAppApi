<?php

/* 
 * create by Mohammad 
 * 6/11/2018
 * by HP
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['idcus'])    &&
    isset($_POST['dater'])    &&
    isset($_POST['dtcus'])    &&    
    isset($_POST['csspr'])    &&    
    isset($_POST['cssdc'])    &&    
    isset($_POST['activ'])    && 
    isset($_POST['nm_cs'])    &&  
    isset($_POST['b_total'])  && 
    isset($_POST['sb_type'])  &&
    isset($_POST['notes'])){
    
    $idcus    = $_POST['idcus'];
    $dater    = $_POST['dater'];
    $dtcus    = $_POST['dtcus'];
    $csspr    = $_POST['csspr'];
    $cssdc    = $_POST['cssdc'];
    $activ    = $_POST['activ'];
    $nm_cs    = $_POST['nm_cs'];
    $b_total  = $_POST['b_total'];
    $sb_type  =$_POST['sb_type'];
    $notes    = $_POST['notes'];
    
    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql inserting a new row
    $result = mysqli_query($db->_connect(),"INSERT INTO req_ot(idcus,dater,dtcus,csspr,cssdc,activ,notes) VALUES($idcus','$dater','$dtcus','$csspr','$cssdc','$activ','$notes')");
    $result = mysqli_query($db->_connect(),"INSERT INTO s_bills(idcus,nm_cs,b_total,sb_type,sb_date,b_type) VALUES('$idcus', '$nm_cs','$b_total','$sb_type','$dater','1')");
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Purchases bill successfully created.";

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


