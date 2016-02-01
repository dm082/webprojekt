<?php

session_start();

// Email Wert wird verhasht um "anonyme" Ordner zu erhalten
$directorywert = md5($_SESSION['email']);

// Dateien werden in den jeweiligen Ordner basierend auf dem Email Hash abgelegt
$target_dir = "uploads/$directorywert/";
// Mithilfe von preg_replace werden ungültige Zeichen, die zu Problemen führen können, ersetzt.

/* Erhalten der Variablen durch Ajax von showuploads.php*/
$altername = $_POST['info'];
$namenswunsch = $_POST['neuername'];

/* Zerlegen der Variable in Name und Endung*/
$path_parts = pathinfo($altername);
$nameohneendung = $path_parts['filename'];
$namenextension = $path_parts['extension'];

/* Hier werden Zeichen zum Schutz vor Komplikationen geändert*/
$namensänderung = $namenswunsch;
$ersteÄnderung = preg_replace ("([^\w\s\d\-_~,;:\[\]\(\).])", '', $namensänderung);
$zweiteÄnderung = preg_replace('/\s+/', '_', $ersteÄnderung);

/* FILENAME und Extension werden zusammengeführt */
$sicherername = $zweiteÄnderung.".".$namenextension;
echo $sicherername;
rename($altername, $target_dir.$sicherername);


/*chmod("uploads/6c4b425b0b3b3436039e50a1434cc890", 0777);
chmod($altername, 0777);
*/

?>

