<?php
include_once 'Item.php';
include_once 'logs.php';
include_once 'render_config.php';

session_start();

$item = new Item();
//
$num_per_page_phone = 4;
$total = 0;
$count = 0;

if (isset($_REQUEST['phone'])) {
    $phone = $_REQUEST['phone'];
} else {
    $phone = 1;
}

$sf_phone = ($phone - 1) * $num_per_page_phone;

$phones = $item->allItems($sf_phone, $num_per_page_phone);

$total_num_rows_phones = $item->countItems();

$total_phones = $total_num_rows_phones['item_id'];

$total_pages_phone = ceil($total_num_rows_phones / $num_per_page_phone);

//$as = $phones->fetch_all(MYSQLI_ASSOC);
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
//
echo $twig->render('index.twig', [
    'phones' => $phones,
    'phone' => $phone,
    'total_pages_phone' => $total_pages_phone,
    'count' => $count,
    'total' => $total
]);

//}
//echo $twig->render('welcome.twig');