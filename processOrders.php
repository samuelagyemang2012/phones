<?php

include_once 'Administrator.php';
include_once 'Encryption.php';
include_once 'Mail.php';

$admin = new Administrator();
$en = new Encryption();
$mail = new Mail();

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $admin->confirmOrder($id);

    $row = $admin->getCustomerDetails($id);
    $data = $row->fetch_array(MYSQLI_ASSOC);

    $f = $data['firstname'];
    $l = $data['lastname'];
    $e = $data['email'];
    $d = $data['date'];

    $nf = $en->decrypt($f);
    $nl = $en->decrypt($l);
    $ne = $en->decrypt($e);
    $nd = $en->decrypt($d);

//    echo $f;

//    $mail->sendConfirmMail($nf, $nl, $ne, $nd);

    header('Location: customer.php');

}