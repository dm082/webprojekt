<?php

session_start();

// Email Wert wird verhasht um "anonyme" Ordner zu erhalten
$directorywert = md5($_SESSION['email']);

// Dateien werden in den jeweiligen Ordner basierend auf dem Email Hash abgelegt
$target_dir = "uploads/$directorywert/";
// Mithilfe von preg_replace werden ung�ltige Zeichen, die zu Problemen f�hren k�nnen, ersetzt.

$insertedfilename = $_POST["newfilename"];
$middlefilename = preg_replace ("([^\w\s\d\-_~,;:\[\]\(\).])", '', $insertedfilename);
$newfilename = preg_replace('/\s+/', '_', $middlefilename);
$ausgabe = "$target_dir/$newfilename";
$oldfilename = $_POST['id'];

//rename($oldfilename , $ausgabe);
rename("$oldfilename" , "y");
echo $oldfilename."test";
echo $_POST["info"]."test";

?>




<!DOCTYPE html>
<html lang="en">


<form action="#" method="post">
    <input name="newfilename" type="text" placeholder="Gib hier den neuen Dateinamen ein." required>
    <input type="submit" name="upload" value="Hochladen"></form>
</html>


