<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 10/7/2018
 * Time: 6:56 PM
 */

class db_connect {

    private $databasename;

    function __construct(){
        $this->databasename = $databasename;
        $this->_connect();
    }

    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }

    function _connect(){
        require_once __DIR__ . '/db_config.php';

        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,$databasename) or die(mysqli_error($this->_connect()));
        mysqli_query($con,"set_character_set_server='utf8'");
        mysqli_query($con,"set names 'utf8'");

        $db = mysqli_select_db($con) or die(mysqli_error($this->_connect())) or die(mysqli_error($this->_connect()));

        return $con;
    }

    function close() {
        // closing db connection
        mysqli_close($this->_connect());
    }
}