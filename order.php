<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 4/11/2016
 * Time: 11:19 PM
 *
 */

session_start();

//echo $_SESSION['email'];

include_once 'render_config.php';

echo $twig->render('order.twig', [
    'email' =>isset($_SESSION['email']) ? $_SESSION['email'] : ''
]);