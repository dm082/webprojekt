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

// Lesbare Zahlen für "Größe"

function readablesize($bytes, $precision = 1)
{
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;

    if (($bytes >= 0) && ($bytes < $kilobyte)) {
        return $bytes . ' B';
// Ist die Bytezahl größer oder gleich als $kilobyte? & ist die Bytezahl gleichzeitig kleiner als Megabyte?
    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
        return round($bytes / $kilobyte, $precision) . ' KB';

    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
        return round($bytes / $megabyte, $precision) . ' MB';

    } elseif ($bytes >= $gigabyte) {
        return round($bytes / $gigabyte, $precision) . ' GB';
    } else {
        return $bytes . ' B';
    }
}




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

    <link href="showuploads.css" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" async></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <title>Meine Uploads</title>

<!-- Sobald der Link gedrückt wird, wird das "nächste" tr Element in Bezug auf a ausgeblendet-->
    <script>
        $(document).ready(function(){
            $("a").click(function(){
                $(this).closest("tr").fadeOut('slow');
            });
        });
    </script>
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
            <th>Delete?</th>
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
                            $prettysize = readablesize($size);
                            $placeoffile = ($dir.$file);
                            echo("
                            <tr class='active'>
                            <td><a href='$placeoffile'>filename: $file </a></td>
                            <td>$extension</td>
                            <td>$prettysize</td>
                            <td>$placeoffile</td>
                            <td><a><i class='fa fa-trash '></i></a></td>
                            </tr>");
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






