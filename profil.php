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

$sql = $db->prepare('SELECT userid, vorname, nachname, email  FROM User WHERE email = :email');
$array = array(
    ':email' => $_SESSION['email']
);
$sql->execute($array);

//Gibt Datensätze untereinander aus

echo "Mein Profil <br />";

while ($row = $sql->fetch()) {
    echo 'Userid: ' . $row['userid'] . '<br />';
    echo 'Vorname: ' . $row['vorname'] . '<br />';
    echo 'Nachname: ' . $row['nachname'] . '<br />';
    echo 'E-Mailadresse: ' . $row['email'] . '<br />';
    };

?>


<html>

<h3>Profilfoto</h3>
<hr>
<div class="useravatar">
    <img alt="bild" src="http://placekitten.com/g/400/200">
    <p></p>
    <div id="upload" >
        <form action="profilfoto.php" method="post" enctype="multipart/form-data">
            Bild: <input type="file" name="bild"> <input type="submit" name="upload" value="Hochladen">
        </form>

    </div>
</div>


<h3> Mein Passwort ändern </h3>

<form class="form-horizontal" role="form" action="#.php" method="post">
    <div class="form-group">
        <label class="col-lg-3 control-label">Altes Passwort </label>
        <div class="col-lg-8">
            <input class="form-control" name="passwort" type="text" value="Gib hier dein altes Passwort ein.">
        </div>
    </div>
    <p></p>
    <div class="form-group">
        <label class="col-lg-3 control-label">Neues Passwort</label>
        <div class="col-lg-8">
            <input class="form-control" name="vorname" type="text" value="Gib hier dein neues Wunschpasswort ein.">
        </div>
    </div>
    <p></p>
    <div class="form-group">
        <label class="col-lg-3 control-label">Neues Passwort wiederholen</label>
        <div class="col-lg-8">
            <input class="form-control" name="vorname" type="text" value="Bitte wiederhole dein Wunschpasswort.">
        </div>
    </div>
    <p></p>
    <input type="submit" name="upload" value="Aktualisieren">
</form>

</html>