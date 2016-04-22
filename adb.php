<?php
include_once 'db_config.php';

class Adb extends mysqli
{
    /**
     * Adb constructor.
     */
    public function __construct(){

        parent::__construct(DB_HOST, DB_USER, DB_PWORD, DB_NAME, DB_PORT);

        if (mysqli_connect_error()){

            trigger_error("Database ".DB_NAME." does not exist.");
            header('Location: dberror.php');
//            echo"error.";

        }
    }
}