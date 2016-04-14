<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/21/2016
 * Time: 10:57 PM
 */

include_once 'Item.php';
include_once 'render_config.php';

session_start();

$item = new Item();

$data = $item->getBrands();
$brands = $data->fetch_all(MYSQLI_ASSOC);
$b['brands'] = $brands;

$total = 0;
if (count($_SESSION['cart']) === 0) {
    header('Location: cart.php');
}

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

    foreach ($_SESSION['cart'] as $p_id => $details) {
        $total += $_SESSION['cart'][$p_id]['total'];
    }
}

$data = $item->allCountries();
$row = $data->fetch_all(MYSQLI_ASSOC);
$countries['countries'] = $row;

echo $twig->render('checkout.twig', [
    'carts' => isset($_SESSION['cart']) ? $_SESSION['cart'] : '',
    'total' => $total,
    'countries' => $row,
    'brands' => $brands
//            'email' => isset($_SESSION['email']) ? $_SESSION['email'] : ''
]);
