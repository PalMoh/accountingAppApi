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
if (isset($_GET["idcus"])) {
      $idcus= $_GET['idcus'];

    // get a product from products table
    $result = mysqli_query($db->_connect(),"SELECT *FROM cus_ksf WHERE idcus = $idcus");

    if (!empty($result)) {
        // check for empty result
        if (mysqli_num_rows($result) > 0) {
            $response["cus_ksf"] = array();

            while ($row = mysqli_fetch_array($result)) {
                
                $cus_ksf = array();
                $cus_ksf["idcus"] = $row["idcus"];
                $cus_ksf["idseq"] = $row["idseq"];
                $cus_ksf["cdat"] = $row["cdat"];
                $cus_ksf["id_cy"] = $row["id_cy"];
                $cus_ksf["trafc"] = $row["trafc"];
                $cus_ksf["wdrs"] = $row["wdrs"];
                $cus_ksf["pynm"] = $row["pynm"];
                $cus_ksf["blnc"] = $row["blnc"];
                $cus_ksf["detl"] = $row["detl"];
                $cus_ksf["note"] = $row["note"];
                $cus_ksf["archiv"] = $row["archiv"];
                $cus_ksf["active"] = $row["active"];


                array_push($response["cus_ksf"], $cus_ksf);
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
