<?php
session_start();

include("connection.php");
$directorywert = md5($_SESSION['email']);
$bildanzeige = $_REQUEST["pk"];

// Check die Verbindung
if ($_SESSION['loggedin'] != 1) {
    // Wenn der User die Session nicht auf 1 hat, wird er auf die Loginseite zur�ckgeleitet
    header("Location: loginsite.html");
    exit;
}
if (isset($_SESSION['loggedin'])) {
    header("https://mars.iuk.hdm-stuttgart.de/~dm082/phptest/$bildanzeige");
    //echo "Session-Email:". ($_SESSION['email']. "<br/>");
}




