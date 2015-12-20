<?php
session_start();

include ("connection.php");
$directorywert = md5($_SESSION['email']);
$dir = "uploads/$directorywert/";

// Check die Verbindung

if ($_SESSION['loggedin'] != 1) {
    // Wenn der User die Session nicht auf 1 hat, wird er auf die Loginseite zurückgeleitet
    header("Location: loginsite.html");
    exit;
}

if( isset( $_SESSION['loggedin'] ) )
{
    echo "Session-Email:". ($_SESSION['email']. "<br/>");
}


// Open a known directory, and proceed to read its contents



// Open a directory, and read its contents
/* Läuft, kann aber bald gelöscht werden da unten vorhanden
if (is_dir($dir)){
    if ($dh = opendir($dir)){
        while (($file = readdir($dh)) !== false){
            if($file != "." && $file != ".."){
            echo "<a href='$dir$file'>filename:" . $file . "</a><br>";
            }
        }
        closedir($dh);
    }
}
*/

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meine Uploads</title>
</head>
<body>
<body>
<div id="tablecontainer">
    <h1>Directory Contents</h1>

    <table class="userfiles">
        <thead>
        <tr>
            <th>Filename</th>
            <th>Type</th>
            <th>Size</th>
            <th>Date Modified</th>
        </tr>
        </thead>
        <tbody>
        <?php
            if (is_dir($dir)){
                if ($dh = opendir($dir)){
                    while (($file = readdir($dh)) !== false){
                        if($file != "." && $file != ".."){
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                            $size = filesize($dir.$file);
                            $placeoffile = $dir.$file;
                            echo("
                            <td><a href='$placeoffile'>filename: $file </a></td>
                            <td>$extension</td>
                            <td>$size</td>
                            <td>$placeoffile</td>
                            <tr>");
                        }
                    }
                    closedir($dh);
                }
            }
        ?>


        </tbody>
    </table>


</body>
</html>






