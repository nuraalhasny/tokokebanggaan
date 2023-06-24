<?php
    session_start();

    $id = $_GET['id'];
    $qty = $_GET['qty'];
    $items = $_SESSION['items'];

    if ($items) {
        foreach ($items as $key => $value) {
            if ($value['id'] == $id) {
                $_SESSION['items'][$key]['qty'] = $qty;
            }
        }
    }
    
    header("Location: /cart.php");
    exit();
?>