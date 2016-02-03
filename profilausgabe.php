<?php


// Session starten
session_start ();

// Datenbankverbindung aufbauen
include ("connection.php");


// Check die Verbindung
/*
if ($_SESSION['loggedin'] != 1) {
    // Wenn der User die Session nicht auf 1 hat, wird er auf die Loginseite zur�ckgeleitet
    header("Location: loginsite.html");
    exit;
}

if( isset( $_SESSION['loggedin'] ) ) {
    echo "Session-Email:" . ($_SESSION['email'] . "<br/>");

}
*/

//Daten aus DB herauslesen

$sql = $db->prepare('SELECT userid, vorname, nachname, email  FROM User WHERE email = :email');
$array = array(
    ':email' => $_SESSION['email']
);
$sql->execute($array);

//Gibt Datensätze untereinander aus


while ($row = $sql->fetch()) {
  //  echo 'Userid: ' . $row['userid'] . '<br />';
    echo '<i class="fa fa-user"></i></i>&nbsp;&nbsp;' . $row['vorname'] ."&nbsp;" . $row['nachname'] .'<br />';
    echo '<i class="fa fa-envelope"></i></i>&nbsp;&nbsp;'. $row['email'] . '<br />';
};

?>