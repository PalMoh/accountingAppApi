<?php

/*
 * Following code will update a product information
 * A product is identified by product id (id_pf)
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['id_pf']) && isset($_POST['arnam']) && isset($_POST['actype'])&& isset($_POST['fnpay']) && isset($_POST['fnsel'])) {
    
    $id_pf= $_POST['id_pf'];
    $arnam = $_POST['arnam'];
    $actype = $_POST['actype'];
    $fnpay = $_POST['fnpay'];
    $fnsel = $_POST['fnsel'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql update row with matched pid
    $result = mysqli_query($db->_connect(),"UPDATE product SET name = '$arnam', actype ='$actype', fnpay = '$fnpay', fnsel = '$fnsel' WHERE id_pf = $id_pf");

    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully updated.";
        
        // echoing JSON response
        echo json_encode($response);
    } else {
        
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
