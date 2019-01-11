<?php
header('Content-Type: text/html; charset=utf-8');

/*
 *create by HP 11/4/18
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// get all products from products table

$result = mysqli_query($db->_connect(),"SELECT *FROM product") or die(mysqli_error($db->_connect()));


// check for empty result
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["products"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["id_pf"] = $row["id_pf"];
        $product["idknd"] = $row["idknd"];
        $product["actyp"] = $row["actyp"];
        $product["arnam"] = $row["arnam"];
	    $product['isret'] = $row['isret'];
	    $product['dfqnt'] = $row['dfqnt'];
	    $product['fqunt'] = $row['fqunt'];
	    $product['mqunt'] = $row['mqunt'];
	    $product['ogsel'] = $row['ogsel'];
	    $product['adsel'] = $row['adsel'];
	    $product['fnsel'] = $row['fnsel'];
	    $product['sqsel'] = $row['sqsel'];
	    $product['mnpay'] = $row['mnpay'];
	    $product['fnpay'] = $row['fnpay'];

        // push single product into final response array
        array_push($response["products"], $product);
    }
    // success
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response,JSON_UNESCAPED_UNICODE);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";

    // echo no users JSON
   echo json_encode($response,JSON_UNESCAPED_UNICODE);
}
?>
