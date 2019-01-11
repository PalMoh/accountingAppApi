<?php
 
/*
 * Create by HP 5/11/2018
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['id_pf']) &&
    isset($_POST['idknd']) && 
    isset($_POST['actyp']) &&
    isset($_POST['arnam']) && 
    isset($_POST['punit']) && 
    isset($_POST['aunit']) && 
    isset($_POST['isret']) && 
	isset($_POST['isqnt']) && 
    isset($_POST['fnsel']) &&
    isset($_POST['databasename'])&&  	
	isset($_POST['fnpay']) ){
 
    $id_pf = $_POST['id_pf'];
	$idknd = $_POST['idknd'];
	$actyp = $_POST['actyp'];
	$arnam = $_POST['arnam'];
	$punit = $_POST['punit'];
	$aunit = $_POST['aunit'];
	$isret = $_POST['isret'];
	$isqnt = $_POST['isqnt'];
	$fnsel = $_POST['fnsel'];
	$fnpay = $_POST['fnpay'];
	$databasename = $_POST['databasename'];
   

    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
    // mysql inserting a new row
    $result = mysqli_query($db->_connect(),"INSERT INTO product(id_pf,idknd,actyp,arnam,punit,aunit,isret,isqnt,fnsel,fnpay)
                                   	VALUES('$id_pf','$idknd','$actyp','$arnam','$punit','$aunit','$isret','$isqnt','$fnsel','$fnpay')");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Product successfully created.";
 
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
