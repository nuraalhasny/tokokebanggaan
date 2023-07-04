<?php

require_once dirname(__FILE__) . '/../config.php';
require_once dirname(__FILE__) . '/../midtrans-config.php';
require_once dirname(__FILE__) . '/../midtrans/Midtrans.php';
require_once dirname(__FILE__) . '/../helper/logger.php';

try {
  \Midtrans\Config::$isProduction = false;
  \Midtrans\Config::$serverKey = MT_SERVER_KEY;
  
  $notif = new \Midtrans\Notification();
  
  $transaction = $notif->transaction_status;
  $type = $notif->payment_type;
  $order_id = $notif->order_id;
  $fraud = $notif->fraud_status;

  $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  $result = $conn->query("SELECT * FROM payments WHERE order_id = '$order_id'");
  
  $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  if ($result->num_rows == 0) {
    $result = $conn->query("INSERT INTO payments (order_id, purchase_date, status, fraud_status, `type`) VALUES ('$order_id', NOW(), '$transaction', '$fraud', '$type')");
    writeLog("INSERT INTO payments (order_id, purchase_date, status, fraud_status, `type`) VALUES ('$order_id', NOW(), '$transaction', '$fraud', '$type')");
  } else {
    $result = $conn->query("UPDATE payments SET `status` = '$transaction', fraud_status = '$fraud', `type` = '$type' WHERE order_id='$order_id'");
    writeLog("UPDATE payments SET `status` = '$transaction', fraud_status = '$fraud', `type` = '$type' WHERE order_id='$order_id'");
  }
  
  writeLog("Store To Database: $result");
  
  $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
  $result = $conn->query("SELECT * FROM payments WHERE order_id='$order_id'");
  while ($childItem = $result->fetch_assoc()) { 
    writeLog(json_encode($childItem));
  }
  
  if ($transaction == 'capture') {
    // For credit card transaction, we need to check whether transaction is challenge by FDS or not
    if ($type == 'credit_card'){
      if($fraud == 'challenge'){
          writeLog("Transaction order_id: " . $order_id ." is challenged by FDS");
      } else {  
          writeLog("Transaction order_id: " . $order_id ." successfully captured using " . $type);
      }
    }
  } else if ($transaction == 'settlement'){
    writeLog("Transaction order_id: " . $order_id ." successfully transfered using " . $type);
  } else if($transaction == 'pending'){
    writeLog("Waiting customer to finish transaction order_id: " . $order_id . " using " . $type);
  } else if ($transaction == 'deny') {
    writeLog("Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.");
  } else if ($transaction == 'expire') {
    writeLog("Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.");
  } else if ($transaction == 'cancel') {
    writeLog("Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.");
  }
} catch (\Throwable $th) {
  writeLog($th);
}