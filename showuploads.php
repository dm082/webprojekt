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
    <link href="css/bootstrap-editable.css" rel="stylesheet"/>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-editable.min.js"></script>
    <meta charset="UTF-8">
    <!-- main.js -->
    <script src="js/main.js"></script>

    <title>Meine Uploads</title>

    <!-- Sobald der Link gedrückt wird, wird das "nächste" tr Element in Bezug auf a ausgeblendet-->
    <script>
        /*--------------------------------LÖSCHEN ----------------------------*/
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
    <!-- Erscheinen des Linkinfo Felds-------------------------------->
    <script>
        $(document).ready(function() {
            $(document).on('click', '.linkinfo', function (e) {
                $('[data-toggle="popover"]').popover();
                $.fn.editable.defaults.mode = 'inline';
            })
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


    <!-- Umbennen und Neuladen des Dateinamens - Inline! ------------------>
    <script>
        $(function() {
            $.fn.editable.defaults.mode = 'inline';
            $(document).on('click', '.edit', function (e) {
                e.stopPropagation();
                $(this).parent().prev('td').prev('td').prev('td').find('a').editable('toggle');
            });

            $('publicname-change').editable();
            $(document).on('click', '.editable-submit', function () {
                var pkk = $(this).closest('td').find('a').attr('data-pk');
                var value = $('.input-sm').val();
                $.ajax({
                    url: "rename.php",
                    type: 'POST',
                    data: {value: value,pk: pkk, name},
                    success: function(){
                        $("#nachricht").load("showuploads.php #nachricht");
                    }
                });
            });

            $(document).on('click', '.editable-submit', function (e) {
                $("#userfiles").load("showuploads.php #userfiles");
            });
        });







    </script>

<script>
    $(document).on("click", ".share", function () {
        var newId = $(this).attr('id');
        $(".modal-body #modalshare").val( newId );
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
                <li><a href="showuploads.php">&Uuml;bersicht</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<div id="tablecontainer">
    <h1>Directory Contents</h1>
    </div>
    <table id="userfiles">
        <thead>
        <tr>
            <th>Filename</th>
            <th >Type</th>
            <th>Size</th>
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
                        $fullpath = 'https://mars.iuk.hdm-stuttgart.de/~dm082/phptest/'.$placeoffile;
                        echo("
                            <tr class='active'>
                            <td class='dateiname'><a id='name' class='publicname-change' data-name='$file' data-pk='$placeoffile' data-type='text' href='$placeoffile'><span>$file</span></a></td>
                            <td>$extension</td>
                            <td>$prettysize</td>
                            <td class=''><a class='edit'><i class=' fa fa-pencil-square-o'></i></a></td>
                            <td><a href='#' title='Ihr Link' data-toggle='popover' data-trigger='click' data-placement='left' data-content='https://mars.iuk.hdm-stuttgart.de/~dm082/phptest/$placeoffile'><i id=$placeoffile class='linkinfo fa fa-link'></i></a></td>
                            <td><a href='#myModal'  data-toggle=\"modal\"><i id='$fullpath' class='share fa fa-share'></i></a></td>
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
                            <label for="modalshare" class="control-label">Nachricht (max. 250 Zeichen):</label>
                            <input type="text" class="form-control" id="modalshare" name="modalshare" value="lolo"/>
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



