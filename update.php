<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 3/31/2016
 * Time: 2:02 AM
 */
include_once 'Administrator.php';
include_once 'Item.php';

$admin = new Administrator();
$item = new Item();

if (isset($_POST['name'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $qty = $_POST['qty'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];

    $row = $admin->update($name, $qty, $price, $id);

    header('Location: admin.php');

}