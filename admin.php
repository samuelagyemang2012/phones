<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 2/12/2016
 * Time: 7:47 PM
 */
include_once 'Item.php';
include_once 'Administrator.php';
include_once 'Encryption.php';
include_once 'render_config.php';

session_start();

$admin = new Administrator();
$i = 0;
$wid = null;
$total = 0;

$numPerPage = 10;

if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $numPerPage;

$admin = new Administrator();
$item = new Item();

$all = $admin->getAllItems();
$allbrands = $item->getBrands();

$totalNumRows = $item->countItems();
$total_phones = $totalNumRows['item_id'];

$total_pages = ceil($totalNumRows / $numPerPage);

//$ar = $all->fetch_all(MYSQLI_ASSOC);
//$ab = $allbrands->fetch_all(MYSQLI_ASSOC);
array('phones' => $all);
array('phones' => $allbrands);

//$allData['phones'] = $ar;
//$allB['brands'] = $ab;

/** @var array $data */
echo $twig->render('admin.twig', [
    'phones' => $all,
    'brands' => $allbrands,
    'total_clothes' => $total_phones,
    'page' => $page,
    'totalPages' => $total_pages
]);

