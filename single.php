<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/20/2016
 * Time: 3:47 PM
 */
session_start();

include_once 'Item.php';
include_once 'render_config.php';

$item = new Item();
$pn_id = null;
$total = 0;
$count = 0;
//
if (isset($_GET['id'])) {
    $id = $_GET['id'];
//
    $phone = $item->getItemDetails($id);
    $pn_details = $phone->fetch_array(MYSQLI_ASSOC);
//
//
    if (isset($_GET['action'])) {
        $pn_id = $_GET['id'];
        $action = $_GET['action'];

        if (!isset($_SESSION['cart'][$pn_id])) {
            $sk_d = $item->getItemDetails($pn_id);
            $addItem = $sk_d->fetch_array(MYSQLI_ASSOC);

            $_SESSION['cart'][$pn_id] = [
                'item' => $addItem['item_id'],
                'phone_name' => $addItem['item_name'],
                'brand_name' => $addItem['brand_name'],
                'quantity' => 1,
                'pic' => $addItem['pic'],
                'qty' => $addItem['qty'],
                'price' => $addItem['price'],
                'total' => $addItem['price']
            ];

            header('Location: index.php');
        }
    }
}

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

    foreach ($_SESSION['cart'] as $skirt_id => $details) {
        $count++;
        $total += $_SESSION['cart'][$skirt_id]['total'];
    }
} else {
    $count = 0;
    $total = 0;
}
//print_r($_SESSION['cart']);

echo $twig->render('single-product.twig', [
    'phone_name' => $pn_details['item_name'],
    'phone_id' => $pn_details['item_id'],
    'phone_brand_name' => $pn_details['brand_name'],
    'phone_price' => $pn_details['price'],
    'phone_qty' => $pn_details['qty'],
    'phone_pic' => $pn_details['pic'],
    'count' => $count,
    'total' => $total
]);