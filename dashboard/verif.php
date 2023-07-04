<?php
require_once 'config.php';
echo $_REQUEST['submit'] ?? '';

if(isset($_REQUEST['submit'])){
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $sql = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
    $result = $conn -> query ($sql);
    
    session_start();
    if ($result -> num_rows <= 0) {
        $_SESSION['message'] = 'log in invalid';
        header('location: dashboard.php');
    }

    while($row = $result -> fetch_assoc()){
        $_SESSION['username_admin'] = $row['username'];
        $_SESSION['name'] = $row['name'];
        header('location: index.php');
    }
    
    
}
