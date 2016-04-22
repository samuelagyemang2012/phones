<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 4/22/2016
 * Time: 4:07 AM
 */
include_once 'Administrator.php';
//include_once "";
require_once 'render_config.php';

$a = new Administrator();

if (isset($_POST['usr'])) {

    $username = trim($_POST['usr']);
    $password = trim($_POST['pwd']);

    $data = $a->login($username, $password);
    $logs = $data->fetch_array(MYSQLI_ASSOC);

    if (strlen($username)===0 || strlen($password)===0) {
        header('Location: login.php');
    } else {

        if (strcmp($username, $logs['admin_name']) === 0 && strcmp($password, $logs['admin_pass']) === 0) {
            header('Location: admin.php');
        } else {
            header('Location: login.php');
        }
    }
}

echo $twig->render('login.twig', [

]);