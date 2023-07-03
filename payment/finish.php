<?php

require_once '../config.php';
require_once dirname(__FILE__) . '/../helper/logger.php';

session_start();

try {
    $totals = [];
    $items = $_SESSION['items'] ?? null;

    $order_id = $_GET['order_id'];
    $transaction_status = $_GET['transaction_status'];

    $user_id = $_SESSION['user_id'] ?? null;
    $courier = $_SESSION['shipping']['courier'] ?? null;
    $service = $_SESSION['shipping']['service'] ?? null;
    $address = $_SESSION['shipping']['address'] ?? null;
    $destination_id = $_SESSION['shipping']['city_id'] ?? null;

    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    foreach($items as $item) {
        $result = $conn->query("SELECT purchase_price FROM products WHERE id = '".$item['id']."'");

        while ($childItem = $result->fetch_assoc()) { 
            array_push($totals, $item['qty'] * $childItem['purchase_price']);
        }
    }

    $subtotal = array_sum($totals);

    $sql = "INSERT INTO invoices (user_id, destination_id, courier, service, address) VALUES ('$user_id', '$destination_id', '$courier', '$service', '$address')";
    $conn->query($sql);
    $invoice_id = $conn->insert_id;

    $sql = "";
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    foreach($items as $key => $item) {
        $conn->query("INSERT INTO product_checkouts (invoice_id, product_id, size_id, qty, total) VALUES ('$invoice_id', '".$item['id']."', '".$item['size']."', '".$item['qty']."', '".$totals[$key]."')");
    }

    $grand_total = $subtotal + $_SESSION['shipping']['price'];

    
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    $result = $conn->query("SELECT * FROM payments WHERE order_id = '$order_id'");
    
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if ($result->num_rows == 0) {
        $result = $conn->query("INSERT INTO payments (invoice_id, order_id, purchase_date, status, total) VALUES ('$invoice_id', '$order_id', NOW(), '$transaction_status', $grand_total)");
        writeLog("INSERT INTO payments (invoice_id, order_id, purchase_date, status, total) VALUES ('$invoice_id', '$order_id', NOW(), '$transaction_status', $grand_total) - is succes : $sql");
    } else {    
        $result = $conn->query("UPDATE payments SET `invoice_id` = '$invoice_id', total = '$grand_total' WHERE order_id='$order_id'");
        writeLog("UPDATE payments SET `invoice_id` = '$invoice_id', total = '$grand_total' WHERE order_id='$order_id'");
    }
    
    // unset($_SESSION['items']);
    // unset($_SESSION['shipping']);

    header('location: /order.php');
} catch (\Throwable $th) {
    print_r($th);
    die;
}