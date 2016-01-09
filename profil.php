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


//Daten aus DB herauslesen

$sql = $db->prepare('SELECT userid, vorname, nachname, email, passwort FROM User WHERE email = :email');
$array = array(
    ':email' => $_SESSION['email']
);
$sql->execute($array);

//Gibt Datensätze der aktuellen Session untereinander aus

while ($row = $sql->fetch()) {
    echo $row['userid'] . '<br />';
    echo $row['vorname'] . '<br />';
    echo $row['nachname'] . '<br />';
    echo $row['email'] . '<br />';
    echo $row['passwort'] . '<br />';
    };

?>