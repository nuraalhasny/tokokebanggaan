<?php

require_once('config.php');

$prov_id = $_POST['prov_id'];
$city_id = $_POST['city_id'];
$courier = $_POST['courier'];
$service = $_POST['service'];
$address = $_POST['address'];

$start_price = strpos($service, '-')+1;
$end_price = strpos($service, '(');
$diff_price = $end_price - $start_price;
$price = substr($service, $start_price, $diff_price);

session_start();
$_SESSION['shipping'] = [
    'prov_id' => $prov_id,
    'city_id' => $city_id,
    'courier' => $courier,
    'service' => $service,
    'address' => $address,
    'price' => $price
];

header('location: /cart.php');