<?php
session_start();
if(!isset($_SESSION['username_admin'])){
    header('location: dashboard.php');
}