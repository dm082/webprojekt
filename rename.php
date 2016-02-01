<?php

session_start();

// Email Wert wird verhasht um "anonyme" Ordner zu erhalten
$directorywert = md5($_SESSION['email']);

// Dateien werden in den jeweiligen Ordner basierend auf dem Email Hash abgelegt
$target_dir = "uploads/$directorywert/";
// Mithilfe von preg_replace werden ungültige Zeichen, die zu Problemen führen können, ersetzt.

$insertedfilename = $_POST["newfilename"];


$altername = $_POST['id'];


$path_parts = pathinfo($altername);
echo $path_parts['filename'], "\n";



chmod("uploads/6c4b425b0b3b3436039e50a1434cc890", 0777);
chmod($altername, 0777);

$middlefilename = preg_replace ("([^\w\s\d\-_~,;:\[\]\(\).])", '', $insertedfilename);
$newfilename = preg_replace('/\s+/', '_', $middlefilename);



rename("$altername", $target_dir."");

/*
$ausgabe = "$target_dir/$newfilename";
$oldfilename = $_POST['id'];

//rename($oldfilename , $ausgabe);
rename("$oldfilename" , "newname");
echo $oldfilename."test";
echo $_POST["info"]."test";
*/
?>




<!DOCTYPE html>
<html lang="en">


<form action="#" method="post">
    <input name="newfilename" type="text" placeholder="Gib hier den neuen Dateinamen ein." required>
    <input type="submit" name="upload" value="Hochladen"></form>
</html>


