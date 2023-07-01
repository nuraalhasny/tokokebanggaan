<?php
    session_start();
    
    if(!isset($_SESSION['username'])) {
        $_SESSION['message'] = 'Login Dulu Untuk Melanjutkan';
        header('location: login.php');
    }

    $id = $_GET['id'];
    $size = $_GET['size'];
    if (!$_SESSION['items']) $_SESSION['items'] = [];

    array_push($_SESSION['items'], [
        'id' => $id,
        'size' => $size,
        'qty' => 1,
    ]);
    
    header("Location: /cart.php");
    exit();
?>