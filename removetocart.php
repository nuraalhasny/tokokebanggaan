<?php
    session_start();

    $id = $_GET['id'];
    $items = $_SESSION['items'];

    if ($items) {
        foreach ($items as $key => $value) {
            if ($value['id'] == $id) {
                unset($_SESSION['items'][$key]);
            }
        }
    }
    
    header("Location: /cart.php");
    exit();
?>