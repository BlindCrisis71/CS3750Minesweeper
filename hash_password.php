<?php
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


    // Append salt to password
    $salt = '12341234';
    $hashedPassword = $salt . $_POST['hashedPassword'];
    // Rehash password
    $hashedPassword = password_hash($hashedPassword, PASSWORD_DEFAULT);

    // Inserts the user and hashed password into the database
    $sql = "INSERT INTO User (Username, Password) VALUES ('" . $_POST['username'] . "', '" . $_POST['hashedPassword'] . "')";
    $result = $conn->query($sql);