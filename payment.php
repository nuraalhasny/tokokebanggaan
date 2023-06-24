<?php

require_once('vendor/Midtrans.php');
require_once('config.php');

// Inisialisasi objek Midtrans
$midtrans = new Midtrans();
$midtrans->config['server_key'] = MIDTRANS_SERVER_KEY;
$midtrans->config['client_key'] = MIDTRANS_CLIENT_KEY;
$midtrans->config['is_production'] = false;

// Buat data transaksi
$transaction_details = array(
    'order_id' => 'ORDER-ID-ANDA',
    'gross_amount' => 200000
);

$item_details = array(
    array(
        'id' => 'ITEM1',
        'price' => 200000,
        'quantity' => 1,
        'name' => 'Produk 1'
    )
);

$transaction_data = array(
    'transaction_details' => $transaction_details,
    'item_details' => $item_details
);

// Buat token pembayaran
$payment_token = $midtrans->getSnapToken($transaction_data);

// Arahkan pengguna ke halaman pembayaran Midtrans
header('Location: ' . $payment_token);

?>