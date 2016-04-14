<?php
include_once 'Item.php';
include_once 'Encryption.php';
include_once 'Administrator.php';
?>

<html xmlns="http://www.w3.org/1999/html">

<head>
    <title>Easy Admin Panel an Admin Panel Category Flat Bootstrap Responsive Website Template | Tables ::
        w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css'/>
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css'/>
    <!-- Graph CSS -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- jQuery -->
    <!-- lined-icons -->
    <link rel="stylesheet" href="css/icon-font.min.css" type='text/css'/>
    <!-- //lined-icons -->
    <!-- chart -->
    <script src="js/Chart.js"></script>
    <!-- //chart -->
    <!--animate-->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!--//end-animate-->
    <!----webfonts--->
    <link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic'
          rel='stylesheet' type='text/css'>
    <!---//webfonts--->

    <!-- my css -->
    <link href="css/modified.css" rel="stylesheet" type="text/css" media="all">
    <!--//my css-->

    <!-- Meters graphs -->
    <script src="js/jquery-1.10.2.min.js"></script>
    <!-- Placed js at the end of the document so the pages load faster -->

</head>

<body class="sticky-header left-side-collapsed" onload="initMap()">
<div id="page-wrapper">
    <div class="graphs">
        <div class="col-sm-12">
            <div class="xs tabls">
                <div class="bs-example4" data-example-id="contextual-table">
                    <center><h2>Administrator</h2></center>
                    <a href="admin.php" class="btn btn-primary">Back </a>
                    <a href="customer.php" class="btn btn-primary">Refresh </a>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Country</th>
                            <th></th>
                            <!--                            <th>Price</th>-->
<!--                            <th></th>-->
                        </tr>
                        </thead>
</body>
<?php
$admin = new Administrator();
$en = new Encryption();

$data = $admin->orders();

$row = $data->fetch_array(MYSQLI_ASSOC);
$len = mysqli_num_rows($data);

echo "<tbody>";

for ($i = 0; $i < $len; $i++) {

    $de_email = $en->decrypt($row['email']);
    $de_address = $en->decrypt($row['address']);
    $de_country = $en->decrypt($row['country']);

    $data1 = $admin->getCountry($de_country);
    $row1 = $data1->fetch_array(MYSQLI_ASSOC);
    $country = $row1['nicename'];

    echo "<tr class='active'>";
    echo "<td> {$row['order_id']} </td>";
    echo "<td> {$row['date']} </td>";
    echo "<td> $de_email </td>";
    echo "<td> $de_address </td>";
    echo "<td> $country </td>";
    echo "<td> <a class='btn btn_1' href='processOrders.php?id={$row['order_id']}' style='background-color: #00aaf1; color: #fff'>Confirm</a>";
    echo "</tr>";

    $row = $data->fetch_array(MYSQLI_ASSOC);
    $row1 = $data1->fetch_array(MYSQLI_ASSOC);
}
echo "</tbody>";
echo "</table>";
?>


