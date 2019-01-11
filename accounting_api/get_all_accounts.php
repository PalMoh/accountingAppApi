<?php
header('Content-Type: text/html; charset=utf-8');

/*
 *create by HP 10/29/18
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all customers from customers table

$result = mysqli_query($db->_connect(),"SELECT *FROM customer") or die(mysqli_error($db->_connect()));


// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // customers node
    $response["customers"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $customer = array();
        $customer["idcus"]   = $row["idcus"];
        $customer["idgrp"]   = $row["idgrp"];
        $customer["nm_cs"]   = $row["nm_cs"];
        $customer["curr"]    = $row["curr"];
	    $customer['lang']    = $row['lang'];
	    $customer['sblc']    = $row['sblc'];
	    $customer['detl']    = $row['detl'];
	    $customer['isln']    = $row['isln'];
	    $customer['islm']    = $row['islm'];
	    $customer['issl']    = $row['issl'];
	    $customer['ask']     = $row['ask'];
	    $customer['note']    = $row['note'];
	    $customer['archiv']  = $row['archiv'];
	    $customer['trash']   = $row['trash'];

        // push single customer$customer into final response array
        array_push($response["customers"], $customer);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response,JSON_UNESCAPED_UNICODE);
} else {
    // no customers found
    $response["success"] = 0;
    $response["message"] = "No customers found";

    // echo no users JSON
   echo json_encode($response,JSON_UNESCAPED_UNICODE);
}
?>
