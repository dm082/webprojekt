<?php
session_start();
?>

<?php

$dsn    = "mysql::host=mars.iuk.hdm-stuttgart.de; dbname=u-kk111";

try
{
    $db = new PDO($dsn, 'kk111', 'Ooquae9bee', array('charset'=>'utf8'));
}
catch (PDOException $p)
{
    echo ("Fehler bei Aufbau der Datenbankverbindung.");
}


//hello
?>


