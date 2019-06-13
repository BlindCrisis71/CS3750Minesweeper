<?php
    /**
     * Database Configuration
     */
    // class DBConfig
    // {
    //   function initializeDbConnection()
    //   {
    //     // Variables for connecting to the server and database
    //     $servername = ftpupload.net;
    //     $username = epiz_23946308;
    //     $password = FUs75Vs41;
    //     $dbname = epiz_23946308_minesweeper;
    //
    //     // Create connection
    //     $conn = new mysqli($servername, $username, $password, $dbname);
    //     // Check connection
    //     echo("Connecting to DB-Minesweeper<br><br>");
    //     if ($conn) {
    //         die("Connection failed: " . $conn->connect_error);
    //     }
    //   }
    // }

    include('db_service.php');
    $dbService = new DBService();
    $dbService->connectDB();
    $dbService->writeToGameTableDB("3", "Test");
    $dbService->getFromGameTableDB("3");
?>
