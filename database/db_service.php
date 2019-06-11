<?php
/**
 * Database Service
 */
 class DBService
 {
   // Connect DB
   public function connectDB()
   {
     $servername = "sql308.epizy.com";
     $username = "epiz_23946308";
     $password = "FUs75Vs41";
     $dbname = "epiz_23946308_minesweeper";

     $conn = new mysqli($servername, $username, $password, $dbname);

     // Check connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
   }

   // Use to write GameId, BoardData to GameTable
   // Parameter 1: GameId, Parameter 2: BoardData
   public function writeToGameTableDB($gameId, $boardData)
   {
     $servername = "sql308.epizy.com";
     $username = "epiz_23946308";
     $password = "FUs75Vs41";
     $dbname = "epiz_23946308_minesweeper";

     $conn = new mysqli($servername, $username, $password, $dbname);

     // Check connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }

     $sql = "INSERT INTO GameTable (GameId, BoardData) VALUES ('" . $gameId . "', '" . $boardData . "')";
     if ($conn->query($sql) === TRUE) {} else {
       echo "Error: " . $sql . "<br>" . $conn->error;
     }
   }

   // Use to get BoardData from GameTable
   // Parameter 1: GameId
   // Return: BoardData
   public function getFromGameTableDB($gameId)
   {
     $servername = "sql308.epizy.com";
     $username = "epiz_23946308";
     $password = "FUs75Vs41";
     $dbname = "epiz_23946308_minesweeper";

     $conn = new mysqli($servername, $username, $password, $dbname);

     // Check connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }

     $sql = "SELECT * FROM GameTable WHERE GameId = $gameId LIMIT 1";
     $result = $conn->query($sql);
     if ($result->num_rows > 0) {
       $i = 1;
       while ($row = $result->fetch_assoc()) {
           echo " GAME-ID: " . $row["GameId"] . " BOARD-DATA: " . $row["BoardData"] . " <br><br>";
           $i += 1;
       }
       echo "***************************************<br><br>";
      } else {
        echo "NO RESULTS FOUND";
      }
    }
 }
?>
