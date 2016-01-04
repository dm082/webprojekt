<?php

// Session starten
session_start ();

// Datenbankverbindung aufbauen
include ("connection.php");



// Check die Verbindung   -- geklaut vom showuploads-Skript

if ($_SESSION['loggedin'] != 1) {
    // Wenn der User die Session nicht auf 1 hat, wird er auf die Loginseite zur�ckgeleitet
    header("Location: loginsite.html");
    exit;
}

if( isset( $_SESSION['loggedin'] ) ) {
    echo "Session-Email:" . ($_SESSION['email'] . "<br/>");

}


$sql = $db->prepare('SELECT userid, vorname, nachname, email, passwort FROM User');
$array = array(
    ':userid' => $_GET['userid'],
    ':vorname' => $_GET['vorname'],
    ':nachname' => $_GET['nachname'],
    ':email' => $_GET['email'],
    ':passwort' => $_GET['passwort']
);
$sql->execute($array);


//Hier gibt er nur die erste Zeile der Tabelle aus
/* while ($row = $sql->fetch()) {
    echo $row['userid'].'<br />';
    echo $row['vorname'].'<br />';
    echo $row['nachname'].'<br />';
    echo $row['email'].'<br />';
    echo $row['passwort'].'<br />'; */

//Hier gibt er alle Zeilen der Tabelle aus
    while ($_SESSION = $sql->fetch()) {
        echo $_SESSION['userid'].'<br />';
        echo $_SESSION['vorname'].'<br />';
        echo $_SESSION['nachname'].'<br />';
        echo $_SESSION['email'].'<br />';
        echo $_SESSION['passwort'].'<br />';
}
?>