<?php

session_start();

include_once 'Item.php';


//include_once 'edit.php';

if (isset($_REQUEST['cmd'])) {

    $command = $_REQUEST['cmd'];

    switch ($command) {

        case 1:
            getPhoneCode();
            break;
    }
}

function getPhoneCode()
{
    $i = new Item();

    $iso = $_GET['iso3'];

    $p_code = $i->getPhoneCode($iso);
    $data = $p_code->fetch_array(MYSQLI_ASSOC);

    echo '{"result":1, "phonecode":"' . $data["phonecode"] . '"}';

}