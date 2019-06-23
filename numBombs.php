<?php
include "database/dbconfig.php";

    $xClicked = $_GET['x'];
    $yClicked = $_GET['y'];

    $sql = "SELECT numMines FROM minesweeper WHERE xCoordinate= " . $xClicked . " AND yCoordinate = " . $yClicked;
    $result = $conn->query($sql);


    if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
           $numMines = $row['numMines'];
       }
   }
   echo "<span style='visibility:hidden'>"; echo $numMines; echo '</span>';
?>
