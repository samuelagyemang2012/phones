<?php
///**
// * Created by PhpStorm.
// * User: samuel
// * Date: 4/11/2016
// * Time: 6:01 PM
// */
//
//include_once 'Item.php';
//include_once 'Mail.php';
//include_once 'Encryption.php';
//include_once 'render_config.php';
//
//session_start();
//
//$i = new Item();
//$mail = new Mail();
//$enc = new Encryption();
//
//$name_pattern = "/^[A-Za-z]{3,20}$/";
//$address_pattern = "/^\d+\s[A-z]+\s[A-z]+/";
//$email_pattern = "/^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
//$city_pattern = "/^[a-zA-Z0-9\s]/";
//$phone_pattern = "/^[0-9]{9}$/";;
//
//if (isset($_POST['billing_country'])) {
//    $country = $_POST['billing_country'];
//    $firstname = $_POST['billing_first_name'];
//    $lastname = $_POST['billing_last_name'];
//    $company = $_POST['billing_company'];
//    $address = $_POST['billing_address_1'];
//    $city = $_POST['billing_city'];
//    $email = $_POST['billing_email'];
//    $phonecode = $_POST['billing_phone_code'];
//    $phone = $_POST['billing_phone'];
//
//    $n_firstname = trim($firstname);
//    $n_lastname = trim($lastname);
//    $n_address = trim($address);
//    $n_city = trim($city);
//    $n_email = trim($email);
//    $n_phone = trim($phone);
//
//    $s_firstname = stripslashes($n_firstname);
//    $s_lastname = stripslashes($n_lastname);
//    $s_address = stripslashes($n_address);
//    $s_city = stripslashes($n_city);
//    $s_email = stripslashes($n_email);
//    $s_phone = stripslashes($n_phone);
//
//    $t_firstname = strip_tags($s_firstname);
//    $t_lastname = strip_tags($s_lastname);
//    $t_address = strip_tags($s_address);
//    $t_city = strip_tags($s_city);
//    $t_email = strip_tags($s_email);
//    $t_phone = strip_tags($s_phone);
//
//    if (strlen($t_firstname) === 0 || strlen($t_lastname) === 0 || strlen($t_address) === 0 || strlen($t_city) === 0 || strlen($t_email) === 0 || strlen($phonecode) === 0 || strlen($t_phone) === 0) {
//        header("Location: checkout.php");
//    } else {
//
//        $fn_bool = preg_match($name_pattern, $t_firstname);
//        $ln_bool = preg_match($name_pattern, $t_lastname);
//        $ad_bool = preg_match($address_pattern, $t_address);
//        $c_bool = preg_match($city_pattern, $t_city);
//        $e_bool = preg_match($email_pattern, $t_email);
//        $p_bool = preg_match($phone_pattern, $t_phone);
//
////    echo $fn_bool . '<br>';
////    echo $ln_bool . '<br>';
////    echo $ad_bool . '<br>';
////    echo $c_bool . '<br>';
////    echo $e_bool . '<br>';
////    echo $p_bool . '<br>';
//
//        if ($fn_bool === 0 || $ln_bool === 0 || $ad_bool === 0 || $c_bool === 0 || $e_bool === 0 || $p_bool === 0) {
//
//            header("Location: checkout.php");
//        } else {
//
//            $_SESSION['email'] = $t_email;
//            $_SESSION['address'] = $t_address;
//            $new_phone = $phonecode . $t_phone;
//            $data = $i->getCustomerEmail($t_email);
//            $em = $data->fetch_array(MYSQLI_ASSOC);
//
//            /// new customer
//            if (is_null($em['email'])) {
//                $file = "./customer_history/" . "$t_email" . ".txt";
//
//                foreach ($_SESSION['cart'] as $p_id => $details) {
//                    $id = $_SESSION['cart'][$p_id]['item'];
//                    $cart_qty = $_SESSION['cart'][$p_id]['quantity'];
//                    $row = $i->getItemDetails($id);
//                    $d = $row->fetch_array(MYSQLI_ASSOC);
//                    $new_qty = $d['qty'] - $cart_qty;
//                    $new_num_bought = $d['num_bought'] + $cart_qty;
//
//                    $info = $_SESSION['cart'][$p_id]['item'] . "\n";
//
//                    file_put_contents($file, $info, FILE_APPEND);
//
//                    $i->updateItem($id, $new_qty, $new_num_bought);
//                }
//
//                $row = $i->getCustomerDetails($t_email);
//                $cust_details = $row->fetch_array(MYSQLI_ASSOC);
//
//                $ef = $t_firstname;
//                $el = $t_lastname;
//                $ee = $t_email;
//                $ea = $t_address;
//                $ec = $t_city;
//                $eco = $country;
//                $enp = $new_phone;
//
//                $i->makeCustomer($ef, $el, $ee, $ea, $ec, $eco, $enp, $file);
//
//                $row1 = $i->getCustomerDetails($ee);
//                $ss1 = $row1->fetch_array(MYSQLI_ASSOC);
//                $cid = $ss1['cust_id'];
//
//                $i->makeOrder($cid);
////                $mail->sendAlertMail($t_firstname, $t_lastname, $t_email);
//
//                header("Location: order.php");
//            } elseif (!is_null($em['email']) && strcmp($em['email'], $t_email) === 0) {
//                $file1 = "./customer_history/" . "$email" . ".txt";
//
//                $ef = $t_firstname;
//                $el = $t_lastname;
//                $ee = $t_email;
//                $ea = $t_address;
//                $ec = $t_city;
//                $eco = $country;
//                $enp = $new_phone;
//
//                foreach ($_SESSION['cart'] as $p_id => $details) {
//                    $id = $_SESSION['cart'][$p_id]['item'];
//                    $cart_qty = $_SESSION['cart'][$p_id]['quantity'];
//                    $row = $i->getItemDetails($id);
//                    $d = $row->fetch_array(MYSQLI_ASSOC);
//                    $new_qty = $d['qty'] - $cart_qty;
//                    $new_num_bought = $d['num_bought'] + $cart_qty;
//
//                    $info1 = $_SESSION['cart'][$p_id]['item'] . "\n";
//
//                    file_put_contents($file, $info1, FILE_APPEND);
//
//                    $i->updateCustomer($ef, $el, $ee, $ea, $ec, $eco, $enp);
//                    $i->updateItem($id, $new_qty, $new_num_bought);
//                }
//
//                $row1 = $i->getCustomerDetails($ee);
//                $ss1 = $row1->fetch_array(MYSQLI_ASSOC);
//                $cid = $ss1['cust_id'];
//
//                $i->makeOrder($cid);
////                $mail->sendAlertMail();
//                header('Location: order.php');
//            }
//        }
//    }
//}
include_once 'db_config.php';
include_once 'logs.php';
if (!mysqli_connect(DB_HOST, DB_USER, DB_PWORD, "phoones", DB_PORT)) {
    trigger_error("Database " . DB_NAME . " does not exist.");
    header('Location: dberror.php');
};