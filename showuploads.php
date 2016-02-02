<?php
session_start();

include("connection.php");
$directorywert = md5($_SESSION['email']);
$dir = "uploads/$directorywert/";

// Check die Verbindung

if ($_SESSION['loggedin'] != 1) {
    // Wenn der User die Session nicht auf 1 hat, wird er auf die Loginseite zur�ckgeleitet
    header("Location: loginsite.html");
    exit;
}

if (isset($_SESSION['loggedin'])) {
    //echo "Session-Email:". ($_SESSION['email']. "<br/>");
}

// Lesbare Zahlen f�r "Gr��e"

function readablesize($bytes, $precision = 1)
{
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;

    if (($bytes >= 0) && ($bytes < $kilobyte)) {
        return $bytes . ' B';
// Ist die Bytezahl gr��er oder gleich als $kilobyte? & ist die Bytezahl gleichzeitig kleiner als Megabyte?
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
/* L�uft, kann aber bald gel�scht werden da unten vorhanden
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="main.css" rel="stylesheet">
    <link href="showuploads.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/script.js/0.1/script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">

    <title>Meine Uploads</title>

    <!-- Sobald der Link gedr�ckt wird, wird das "n�chste" tr Element in Bezug auf a ausgeblendet-->
    <script>
        /*LÖSCHEN ----------------------------*/
        $(document).ready(function () {
            $(".delete").click(function () {
                //oben event
                //alert(event.target.id);
                var element = $(this);
                var del_id = element.attr("id");
                var info = 'id=' + del_id;
                if (confirm("Are you sure you want to delete this?")) {
                    $.ajax({
                        type: "POST",
                        url: "delete.php",
                        data: info,
                        success: function () {
                        }
                    });
                    $(this).closest('tr').fadeOut('slow');
                }
                return false;
            });
        });
    </script>

    <!-- Teilen Funktion -------------------------------------------------------------------------------->
    <script>
        $(document).ready(function () {
            $(".share").click(function () {
                var element = $(this);
                var share_id = element.attr("id");
                var share_info = 'http://mars.iuk.hdm-stuttgart.de/~dm082/phptest/' + share_id;
                $.ajax({
                    type: "POST",
                    url: ("#myModal").val("nachricht"),
                    data: share_info,
                    success: function () {
                    }
                });
                return false;
            });
        });
        /* Umbenennen ------------------------------------------------------------*/
        $(document).ready(function () {
            $(".senden").click(function(){
                var neuername = $(this).prev('input').val();
                alert(neuername);
                var element = $(this);
                var share_id = element.attr("id");
                var info =  share_id;
                var share_info = 'http://mars.iuk.hdm-stuttgart.de/~dm082/phptest/' + share_id;
                $.ajax({
                    type: "POST",
                    url: "rename.php",
                    data: {info: info, neuername:neuername} ,
                    success: function () {
                    }
                });
                return false;
            });
        });
        $(document).ready(function () {
            $(".senden").click(function () {
                $("#tablecontainer").load("showuploads.php");
            })
        });
        /* Insert Field */
        $(document).ready(function () {
            $(".linkinfo").click(function () {
                $(".testtt").toggleClass("visible");
            })
        });

    </script>

    <!-- Ein und Ausblenden der PopOvers ----------------------------->
    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
        });
    </script>

    <script>
        $('html').on('mouseup', function(e) {
            if(!$(e.target).closest('.popover').length) {
                $('.popover').each(function(){
                    $(this.previousSibling).popover('hide');
                });
            }
        });
    </script>


</head>
<body>
<div>
    <div class="nav">
        <div class="container">
            <ul class="pull-left">
                <li><a href="index.html">VINTLOUD</a></li>
            </ul>
            <ul class="pull-right">
                <li><a href="uploadseitee.html">Upload</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="showuploads.php">&Uuml;bersicht</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<div id="tablecontainer">
    <h1>Directory Contents</h1>
    <div id="load" align="center"><img src="images/loading.gif" width="28" height="28" align="absmiddle"/> Loading...
    </div>
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
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != "." && $file != "..") {
                        $extension = pathinfo($file, PATHINFO_EXTENSION);
                        $size = filesize($dir . $file);
                        $prettysize = readablesize($size);
                        $placeoffile = ($dir . $file);
                        echo("
                            <tr class='active'>
                            <td><input class='testtt' type='text'><a id='name' href='$placeoffile'><span>$file</span></a></td>
                            <td>$extension</td>
                            <td>$prettysize</td>
                            <td><input type='text' placeholder='Neuer Dateiname'><i id=$placeoffile class='senden fa fa-paper-plane'></i> </td>
                            <td><a href='#' title='Ihr Link' data-toggle='popover' data-trigger='click' data-placement='left' data-content='https://mars.iuk.hdm-stuttgart.de/~dm082/phptest/$placeoffile'><i id=$placeoffile class='linkinfo fa fa-link'></i></a></td>
                            <td><a href='#myModal'  data-toggle=\"modal\"><i id=$placeoffile class='share fa fa-share'></i></a></td>
                            <td><a><i id=$placeoffile class='delete fa fa-trash'></i></a></td>
                            </tr>");
                    }
                }
                closedir($dh);
            }
        }
        ?>


        </tbody>
    </table>
</div>

    <!-- Modal HTML -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Datei als Anhang versenden</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="empfaenger" class="control-label">Empfänger:</label>
                            <input type="email" placeholder="E-Mail" required maxlength="40" class="form-control"
                                   id="empfaenger">
                        </div>
                        <div class="form-group">
                            <label for="betreff" class="control-label">Betreff:</label>
                            <input type="text" required maxlength="40" class="form-control" id="betreff">
                        </div>
                        <div class="form-group">
                            <label for="nachricht" class="control-label">Nachricht (max. 250 Zeichen):</label>
                            <textarea maxlength="250" class="form-control" id="nachricht">Der Absender möchte folgende Daten mit Ihnen teilen: https://mars.iuk.hdm-stuttgart.de/~dm082/phptest/<?php echo $placeoffile; ?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Senden</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>
</html>






