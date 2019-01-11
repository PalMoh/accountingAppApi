<?php
 
/*
 * Create by HP 5/11/2018
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['idcus']) &&
    isset($_POST['idseq']) && 
    isset($_POST['cdat']) &&
    isset($_POST['id_cy']) && 
    isset($_POST['trafc']) && 
    isset($_POST['wdrs']) && 
    isset($_POST['pymn']) && 
	isset($_POST['blnc']) && 
	isset($_POST['detl']) ){
 
    $idcus = $_POST['idcus'];
	$idseq = $_POST['idseq'];
	$cdat = $_POST['cdat'];
	$id_cy = $_POST['id_cy'];
	$trafc = $_POST['trafc'];
	$wdrs = $_POST['wdrs'];
	$pymn = $_POST['pymn'];
	$blnc = $_POST['blnc'];
	$detl = $_POST['detl'];
   
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
    $result = mysqli_query($db->_connect(),"INSERT INTO cus_ksf(idcus,idseq,cdat,id_cy,trafc,wdrs,pymn,blnc,detl)
                                   	VALUES('$idcus','$idseq','$cdat','$id_cy','$trafc','$wdrs','$pymn','$blnc','$detl')");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "successfully created.";
 
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
