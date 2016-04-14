<?php

/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 4/13/2016
 * Time: 1:58 AM
 */
class Encryption
{
    public function encrypt($data)
    {
        $pass = 'XDC123as';
        $method = 'aes128';
        $options = 0;
        $iv = "eelectronics9010";

        $en = openssl_encrypt($data, $method, $pass, $options, $iv);

        return $en;
    }

    public function decrypt($data)
    {
        $pass = 'XDC123as';
        $method = 'aes128';
        $options = 0;
        $iv = "eelectronics9010";

        $de = openssl_decrypt($data, $method, $pass, $options, $iv);

        return $de;
    }
}