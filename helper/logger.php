<?php

function writeLog($message) {
    $logFile = dirname(__FILE__) . '/../payment/midtrans.log';
    $fileHandler = fopen($logFile, 'a') or die("Tidak dapat membuka file log.");
    fwrite($fileHandler, date("Y-m-d H:i:s") . ' - ' . $message . PHP_EOL);
    fclose($fileHandler);
}