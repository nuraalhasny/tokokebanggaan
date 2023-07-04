<?php 

require_once dirname(__FILE__) . '/../config.php';

$id = $_POST['id'];
$order_status = $_POST['order_status'];


$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$result = $conn->query("SELECT `status` FROM invoices WHERE id='$id'");

while ($item = $result->fetch_assoc()) {
    $status_before = $item['status'];
}

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$result = $conn->query("UPDATE invoices SET `status` = '$order_status' WHERE id='$id'");

if ($status_before == 'Waiting Confirmation') {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    $result = $conn->query("SELECT * FROM product_checkouts WHERE invoice_id='$id'");

    while ($item = $result->fetch_assoc()) {
        $qty = (int) $item['qty'];
        $product_id = (int) $item['product_id'];
        $childConn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        $childConn->query("UPDATE products SET stok = (stok - $qty) WHERE id='$product_id'");
    }
}

header('location: purchase.php');