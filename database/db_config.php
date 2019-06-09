<?php

    // Variables for connecting to the server and database
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