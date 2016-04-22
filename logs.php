<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 4/22/2016
 * Time: 5:24 AM
 */

//error handler function
function customError($errno, $errstr) {
    $message = "Error: [$errno] $errstr \n";
    error_log ($message, 3, 'log.txt');

}

//set error handler
set_error_handler("customError");
////trigger_error("Value must be 1 or below");
////trigger error
////echo($test);
////echo " ";
////$test=2;
//if ($test>1) {
//    trigger_error("Value must be 1 or below");
//}

