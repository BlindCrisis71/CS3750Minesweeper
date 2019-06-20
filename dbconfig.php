<?php
    /**
     * Database Configuration
     */

        // Variables for connecting to the server and database
        $servername = "localhost";
        $username = "root";
        $password = "newey";
        $dbname = "minesweeper";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }


?>