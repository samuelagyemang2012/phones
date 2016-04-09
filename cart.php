<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/21/2016
 * Time: 9:29 PM
 */

session_start();

include_once 'Item.php';
include_once 'render_config.php';

$total = 0;
$count = 0;
$item = new Item();

if (isset($_GET['id']) && isset($_GET['action'])) {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        $id = $_GET['id'];

        switch ($action) {
            case'add':
                $_SESSION['cart'][$id]['quantity']++;
                $s = $item->getItemDetails($id);
                $addItem = $s->fetch_array(MYSQLI_ASSOC);

                $_SESSION['cart'][$id] = [
                    'item' => $addItem['item_id'],
                    'phone_name' => $addItem['item_name'],
                    'brand_name' => $addItem['brand_name'],
                    'quantity' => $_SESSION['cart'][$id]['quantity'],
                    'pic' => $addItem['pic'],
                    'price' => $addItem['price'],
                    'qty' => $addItem['qty'],
                    'total' => $addItem['price'] * $_SESSION['cart'][$id]['quantity']
                ];

                if ($_SESSION['cart'][$id]['quantity'] >= $_SESSION['cart'][$id]['qty']) {
                    $_SESSION['cart'][$id]['quantity'] = $_SESSION['cart'][$id]['qty'];
                    $_SESSION['cart'][$id]['total'] = 0.90 * $_SESSION['cart'][$id]['total'];
                }

                break;

            case 'sub':
                $_SESSION['cart'][$id]['quantity']--;
                $s = $item->getItemDetails($id);
                $addItem = $s->fetch_array(MYSQLI_ASSOC);

                $_SESSION['cart'][$id] = [
                    'item' => $addItem['item_id'],
                    'phone_name' => $addItem['item_name'],
                    'brand_name' => $addItem['brand_name'],
                    'quantity' => $_SESSION['cart'][$id]['quantity'],
                    'pic' => $addItem['pic'],
                    'price' => $addItem['price'],
                    'qty' => $addItem['qty'],
                    'total' => $addItem['price'] * $_SESSION['cart'][$id]['quantity']
                ];

                if ($_SESSION['cart'][$id]['quantity'] <= 0) {
                    unset($_SESSION['cart'][$id]);
                }
                break;

            case 'del':
                unset($_SESSION['cart'][$id]);
                break;

            case 'cc':
                unset($_SESSION['cart']);
                break;
        }
    }
}

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

    foreach ($_SESSION['cart'] as $skirt_id => $details) {
        $count++;
        $total += $_SESSION['cart'][$skirt_id]['total'];
    }
}


echo $twig->render('cart.twig', [
    'carts' => isset($_SESSION['cart']) ? $_SESSION['cart'] : '',
    'total' => $total,
    'count' => $count
]);