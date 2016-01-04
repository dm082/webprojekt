<?php

// Session starten
session_start ();

// Datenbankverbindung aufbauen
include ("connection.php");


$sql = $db->prepare('SELECT userid, vorname, nachname, email, passwort FROM User WHERE userid=11');
$array = array(
    ':userid' => $_GET['userid'],
    ':vorname' => $_GET['vorname'],
    ':nachname' => $_GET['nachname'],
    ':email' => $_GET['email'],
    ':passwort' => $_GET['passwort']
);
$sql->execute($array);

while ($row = $sql->fetch()) {
    echo $row['userid'].'<br />';
    echo $row['vorname'].'<br />';
    echo $row['nachname'].'<br />';
    echo $row['email'].'<br />';
    echo $row['passwort'].'<br />';

}
?>


