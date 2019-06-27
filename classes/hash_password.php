<?php

session_start();

// Variables used to connect to the database
$servername = "sql308.epizy.com";
$username = "epiz_23946308";
$password = "FUs75Vs41";
$dbname = "epiz_23946308_minesweeper";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$hashedPassword = $_POST['hashedPassword'];
$_SESSION['clientHash'] = $_POST['hashedPassword'];

// Rehash password
$_SESSION['serverHash'] = password_hash($_SESSION['clientHash'], PASSWORD_DEFAULT);