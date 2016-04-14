<?php

/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 4/12/2016
 * Time: 12:31 AM
 */
require_once './PHPMailer-master/PHPMailerAutoload.php';


class Mail
{
    public function sendAlertMail($firstname, $lastname, $email)
    {
        $cust = $firstname . ' ' . $lastname;

        $mail = new PHPMailer;

//        $mail->SMTPDebug = 3;

        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'eelectronics9010@outlook.com';
        $mail->Password = 'XDC123as';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('eelectronics9010@outlook.com', 'eElectronics');
        $mail->addAddress($email, $cust);

        $mail->isHTML(true);

        $mail->Subject = 'Your Order is Being Processed';
        $mail->Body = '<p>Hi ' . $cust . '</p> <p>Your order is being processed. We will get back to you within the next 24hrs.</p>
        <p>Thank you for shopping with us.</p><br> <p style="text-align: left">The e-Electronics Team</p>';

//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//        $mail->SMTPOptions = array(
//            'ssl' => array(
//                'verify_peer' => false,
//                'verify_peer_name' => false,
//                'allow_self_signed' => true
//            )
//        );

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

    public function sendConfirmMail($firstname, $lastname, $email)
    {
        $cust = $firstname . ' ' . $lastname;

        $mail = new PHPMailer;

//        $mail->SMTPDebug = 3;

        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'eelectronics9010@outlook.com';
        $mail->Password = 'XDC123as';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('eelectronics9010@outlook.com', 'eElectronics');
        $mail->addAddress($email, $cust);

        $mail->isHTML(true);

        $mail->Subject = 'Your Order Has Being Processed';
        $mail->Body = '<p>Hi ' . $cust . ',</p>'.
         '<p>Your order has been processed and been shipped.</p>
         <p>Your should recieve your order within the next 48 hrs.</p>
         <p>Thank you for shopping with us.</p>
         <br>
         <p style="text-align: left;">The e-Electronics Team</p>';

//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//        $mail->SMTPOptions = array(
//            'ssl' => array(
//                'verify_peer' => false,
//                'verify_peer_name' => false,
//                'allow_self_signed' => true
//            )
//        );

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }

}