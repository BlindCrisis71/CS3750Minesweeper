<?php
    /**
     * Database Configuration
     */
    class DBConfig
    {
      function initializeDbConnection()
      {
        // Variables for connecting to the server and database
        $servername = ftpupload.net;
        $username = epiz_23946308;
        $password = FUs75Vs41;
        $dbname = epiz_23946308_minesweeper;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        echo("testing db connection");
        if ($conn) {
            die("Connection failed: " . $conn->connect_error);
        }
      }
    }
?>
