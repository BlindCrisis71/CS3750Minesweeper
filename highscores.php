<?php

    include_once ('database/db_config.php');
    include ('classes/Gameboard.php');

    $gameboard = new Gameboard();
?>

<!doctype html>
<html>
    <body>
        <?php $gameboard->randomizeMinePlacement(); ?>
    </body>
</html>
