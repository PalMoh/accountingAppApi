<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['idcus']) &&
    isset($_POST['idgrp']) &&
    isset($_POST['nm_cs']) &&
    isset($_POST['curr'])  &&    
    isset($_POST['lang'])  &&    
    isset($_POST['sblc'])  &&    
    isset($_POST['detl'])  &&    
    isset($_POST['isln'])  &&    
    isset($_POST['islm'])  &&    
    isset($_POST['issl'])  &&  
    isset($_POST['istx'])  &&    
    isset($_POST['ask'])   &&    
    isset($_POST['note'])  &&
    isset($_POST['archiv'])&&   
    isset($_POST['trash'])){
    
    $idcus  = $_POST['idcus'];
    $idgrp  = $_POST['idgrp'];
    $nm_cs  = $_POST['nm_cs'];
    $curr   = $_POST['curr'];
    $lang   = $_POST['lang'];
    $sblc   = $_POST['sblc'];
    $detl   = $_POST['detl'];
    $isln   = $_POST['isln'];
    $islm   = $_POST['islm'];
    $issl   = $_POST['issl'];
    $istx   = $_POST['istx'];
    $ask    = $_POST['ask'];
    $note   = $_POST['note'];
    $archiv = $_POST['archiv'];
    $trash  = $_POST['trash'];

    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql inserting a new row
    $result = mysqli_query($db->_connect(),"INSERT INTO customer(idcus,idgrp,nm_cs,curr,lang,sblc,detl,isln,islm,issl,istx,ask,note,archiv,trash) VALUES('$idcus', '$idgrp','$nm_cs','$curr','$lang','$sblc','$detl','$isln','$islm','$issl','$istx','$ask','$note','$archiv','$trash')");
    $result = mysqli_query($db->_connect(),"INSERT INTO cus_group(idcus,idgrp) VALUES('$idcus', '$idgrp')");

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Account successfully created.";

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


