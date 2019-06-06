<?php
/**
 * Database Service
 */
 include('./db_config.php');
 echo("Database Service<br>");
 $Func = new DBService();
 $Func->connectToDB();

 class DBService
 {
   function connectToDB()
   {
     $Func = new DBConfig();
     $Func->initializeDbConnection();
   }

   // function writeToDB(table, column, value)
   // {
   //   // $sql = "INSERT INTO " . $table . " (" . $username . ") VALUES ('" . $value . "')";
   //   // if ($conn->query($sql) === TRUE) {
   //   // } else {
   //   //   echo "Error: " . $sql . "<br>" . $conn->error;
   //   // }
   // }
   //
   // function getFromDB(select, table, column, value)
   // {
   //   // $sql = "SELECT $select FROM $table WHERE $column = $value";
   //   // $result = $conn->query($sql);
   //   // if ($result->num_rows > 0) {
   //   //    echo "GET DB - SUCCESS<br><br>";
   //   //  } else {
   //   //    echo "GET DB - FAILURE<br><br>";
   //   //  }
   //   //  return $result
   //  }
 }
?>
