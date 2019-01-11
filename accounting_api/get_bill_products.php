<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 11/5/2018
 * Time: 7:48 PM
 */
header('Content-Type: text/html; charset=utf-8'); // Arabic decode

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// check for post data
if (isset($_GET["idsbill"])) {
      $idsbill= $_GET['idsbill'];

    // get a product from products table
    $result = mysqli_query($db->_connect(),"SELECT *FROM b_product WHERE idsbill = $idsbill");

    if (!empty($result)) {
        // check for empty result
        if (mysqli_num_rows($result) > 0) {
            $response["b_products"] = array();

            while ($row = mysqli_fetch_array($result)) {
                
                $b_produsts = array();
                $b_produsts["p_name"] = $row["p_name"];
                $b_produsts["p_our"]  = $row["p_pur"];
                $b_produsts["p_sell"] = $row["p_sell"];
                $b_produsts["p_qu"]   = $row["p_qu"];
              

                array_push($response["b_products"], $b_produsts);
            }
            // success
            $response["success"] = 1;

            // echoing JSON response
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
        } else {
            // no info found
            $response["success"] = 0;
            $response["message"] = "No info found";

            // echo no info JSON
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
        }
    } else {
        // no info found
        $response["success"] = 0;
        $response["message"] = "No info found";

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
