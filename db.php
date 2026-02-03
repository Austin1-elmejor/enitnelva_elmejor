<?php
// FILE: db.php

// Detect if running on XAMPP (Local) or Web (Live)
$whitelist = array('127.0.0.1', '::1', 'localhost');
$is_local = in_array($_SERVER['REMOTE_ADDR'], $whitelist);

if ($is_local) {
    // 🏠 LOCALHOST SETTINGS (Works on XAMPP immediately)
    $host = "localhost";
    $user = "root";       
    $pass = "";           
    $db   = "valentine_db"; 
} else {
    // 🌍 LIVE SETTINGS (You will fill this later for x10Hosting)
    $host = "localhost"; 
    $user = "YOUR_X10_USER"; 
    $pass = "YOUR_X10_PASS"; 
    $db   = "YOUR_X10_DB_NAME";
}

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>