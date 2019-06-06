<?php
include('./db_config.php');

echo("from db-service attemping to call DBConfig");
$Func = new DBConfig();
$Func->initializeDbConnection();
?>
