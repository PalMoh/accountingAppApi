<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 10/8/2018
 * Time: 7:48 PM
 */
header('Content-Type: text/html; charset=utf-8'); // Arabic decode
/*
 *create by HP 9/25/18
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// check for post data
if (isset($_GET["idcus"])) {
      $idcus= $_GET['idcus'];

    
    $result = mysqli_query($db->_connect(),"SELECT *FROM s_bills WHERE idcus = $idcus");

    if (!empty($result)) {
        // check for empty result
        if (mysqli_num_rows($result) > 0) {
            $response["bills"] = array();

            while ($row = mysqli_fetch_array($result)) {
                $bills = array();
                $bills["idsbill"] = $row["idsbill"];
                $bills["nm_cs"] = $row["nm_cs"];
                $bills["b_total"] = $row["b_total"];
                $bills["sb_type"] = $row["sb_type"];
                $bills["b_type"] = $row["b_type"];
                $bills["sb_date"] = $row["sb_date"];

                array_push($response["bills"], $bills);
            }
            // success
            $response["success"] = 1;

            // echoing JSON response
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
        } else {
            // no info found
            $response["success"] = 0;
            $response["message"] = "No Transaction founds for This customer";

            // echo no users JSON
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
        }
    } else {
        // no info found
        $response["success"] = 0;
        $response["message"] = "No Tansaction founds for this customer";

        // echo no info JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response,JSON_UNESCAPED_UNICODE);
}
