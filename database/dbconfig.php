<?php
    /**
     * Database Configuration
     */

        // Variables for connecting to the server and database
        $servername = "ftpupload.net";
        $username = "epiz_23946308";
        $password = "FUs75Vs41";
        $dbname = "epiz_23946308_minesweeper";
 

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }


?>