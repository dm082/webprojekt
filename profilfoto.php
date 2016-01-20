<?php
// Session starten
session_start ();

// Datenbankverbindung aufbauen
include ("connection.php");

//Profilbild abspeichern

if ($_POST['upload']) {
    $bildname = $_FILES['bild']['name'];  //greift auf den Namen der Datei zu
    $bildtmp = $_FILES['bild']['tmp_name'];  //greift auf den temporären Pfad der Datei zu

    echo $bildname."<br>";
    echo $bildtmp;

//    $bildname = '$_SESSION["vorname"].gif';

    if ($bildname!='' AND $bildtmp!='') {    //prüft ob Bildname und Speicherort befüllt sind
  //      $filetype=$_FILES['file']['type'];
   //     if($filetype=='image/jpeg' or $filetype=='image/png' or $filetype=='image/gif' ,{
        $profilbildpfad = "profilbild/$bildname";
        move_uploaded_file($bildtmp, $profilbildpfad);

        $uploadprofilbild = "INSERT INTO User profilbildpfad VALUES :profilbildpfad WHERE email = :email";
        $query = $db->prepare($uploadprofilbild);
        $query->execute(
            array(
                ':profilbildpfad' => $profilbildpfad,
                ':email' => $_SESSION['email'],
            )
        );
            }

 //   }
}
else {
    echo "Upload fehlgeschlagen.";
}
?>