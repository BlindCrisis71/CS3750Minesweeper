<?php
/**
 * Database Service
 */

 $servername = ftpupload.net;
 $username = epiz_23946308;
 $password = FUs75Vs41;
 $dbname = epiz_23946308_minesweeper;

 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 echo("Connecting to DB-Minesweeper<br><br>");
 if ($conn) {
     die("Connection failed: " . $conn->connect_error);
 }

 writeToGameTableDB("1", "Test");
 $board = getFromGameTableDB("1");
 echo $board;

 class DBService
 {
   // Use to write GameId, BoardData to GameTable
   // Parameter 1: GameId, Parameter 2: BoardData
   function writeToGameTableDB($gameId, $boardData)
   {
     $sql = "INSERT INTO GameTable (GameId, BoardData) VALUES ('" . $gameId . "', '" . $boardData . "')";
     if ($conn->query($sql) === TRUE) {
       echo "Success"
     } else {
       echo "Error: " . $sql . "<br>" . $conn->error;
     }
   }

   // Use to get BoardData from GameTable
   // Parameter 1: GameId
   // Return: BoardData
   function getFromGameTableDB($gameId)
   {
     $sql = "SELECT $select FROM GameTable WHERE GameId = $gameId";
     $result = $conn->query($sql);
     if ($result->num_rows > 0) {
        return $result
      } else {
        return "Error - DB could not be reached";
      }
    }
 }
?>
