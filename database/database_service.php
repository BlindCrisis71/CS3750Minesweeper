<?php
/**
 * Database Service
 */
class DBService
{
  include('./db_config.php');

  function connectData(argument)
  {
    echo("Testing- From db-service attemping to call DBConfig from DBService");
    $Func = new DBConfig();
    $Func->initializeDbConnection();
  }
}
?>
