<?php
// Session starten
session_start ();

// Datenbankverbindung aufbauen
include ("connection.php");

//Profilbild abspeichern

if ($_POST['upload']) {
    $bildname = $_FILES['bild']['name'];  //greift auf den Namen der Datei zu
    $bildtmp = $_FILES['bild']['tmp_name'];  //greift auf den temporären Pfad der Datei zu

    echo $bildname . "<br>";
    echo $bildtmp;

    //   $bildname = '$_SESSION["vorname"].gif';

    if ($bildname != '' AND $bildtmp != '') {    //prüft ob Bildname und Speicherort befüllt sind
        //      $filetype=$_FILES['file']['type'];
        //      if($filetype=='image/jpeg' or $filetype=='image/png' or $filetype=='image/gif') {
        $profilbildpfad = "profilbild/$bildname";
        move_uploaded_file($bildtmp, $profilbildpfad);


        //Einfügen in DB
   //     $uploadprofilbild = $db->prepare('INSERT INTO User profilbildpfad VALUES :profilbildpfad WHERE email = :email');
        $uploadprofilbild = $db->prepare('UPDATE User SET profilbildpfad = :profilbildpfad WHERE email = :email');
        $query = array(
            ':profilbildpfad' => $profilbildpfad,
            ':email' => $_SESSION['email'],
        );
        $uploadprofilbild->execute($query);

        echo "Ihr Profilbild wurde erfolgreich ge&auml;ndert. <br />";
        echo "$profilbildpfad. <br />";
        echo "Zur&uuml;ck zum <a href='profil.php'>Profil</a><br/>";
        $error = false;
    }
}
    else {
        echo "Upload fehlgeschlagen.";
        $error = true;
    }

//einfuegen in Profilbildkästle
    if ($error == false) {

        $einfuegen = $db->prepare('SELECT * FROM User WHERE email = :email');
        $array = array(
            ':email' => $_SESSION['email']
        );
        $einfuegen->execute($array);


        while ($row = $einfuegen->fetch()) {
            echo "<img src='" . $row['profilbildpfad'] . "'>";
        };
    }

else {}

$db     = null;

// die();

// wenn erste if Klammer ganz unten erst zugemacht wird, dann kommt gar keine Meldung
?>





