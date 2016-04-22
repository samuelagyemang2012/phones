<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/19/2016
 * Time: 1:25 AM
 */

include_once 'Item.php';
//include_once 'Admin.php';
include_once 'render_config.php';

session_start();

$item = new Item();

$total = 0;
$count = 0;

if (isset($_REQUEST['search'])) {
    $name = $_REQUEST['search'];
    $phones = $item->search($name);

//    $as = $phones->fetch_all(MYSQLI_ASSOC);
//
//    $allPhones['phones'] = $as;
    array('phones' => $phones);

    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

        foreach ($_SESSION['cart'] as $p_id => $details) {
            $count++;
            $total += $_SESSION['cart'][$p_id]['total'];
        }
    } else {
        $count = 0;
        $total = 0;
    }

    echo $twig->render('search.twig', [
        'phones' => $phones,
        'count' => $count,
        'name' => $name,
        'total' => $total
    ]);
}
//echo $twig->render('welcome.twig');