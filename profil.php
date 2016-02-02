<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="profil.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <script src="./js/dropzone.js"></script>
    <link href="./css/basic.css" rel="stylesheet">
    <link href="./css/dropzone.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/script.js/0.1/script.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link href="js/bootstrap.min.js">

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
                <li><a href="showuploads.php">Übersicht</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>


<div class="row text-center">
    <!--  <div class="col-lg-12 col-sm-12 col-xs-12 text-center"> -->

    <div class="card hovercard">
        <div class="cardheader">

        </div>
        <div>
            <a>
                <?php
                include('connection.php');
                $einfuegen = $db->prepare('SELECT * FROM User WHERE email = :email');
                $array = array(
                    ':email' => $_SESSION['email']
                );
                $einfuegen->execute($array);


                while ($row = $einfuegen->fetch()) {
                    echo "<img src='" . $row['profilbildpfad'] . "'>";
                };
                ?>
            </a>


            <div class="title">
                <a data-toggle="modal" href="#BildModal">Profilbild ändern?</a>
            </div>


            <div id="BildModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Profilbild ändern</h4>
                        </div>
                        <div class="modal-body">
                            <form action="profilfoto.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="bild">
                                <input type="submit" name="upload" value="Hochladen">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="info">
            <div class="title">
                <h3>Mein Profil</h3>
            </div>
            <div class="desc">
                <a>  <?php
                    include("profilausgabe.php");
                    ?>
                </a>
            </div>
        </div>

        <div class="bs-example">
            <!-- Button HTML (to Trigger Modal) -->
            <button href="#passwortModal" class="btn btn-info btn-lg" data-toggle="modal">Passwort ändern</button>

            <!-- Modal HTML -->
            <div id="passwortModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Passwort ändern</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form" action="edit.php" method="post">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Altes Passwort </label>

                                    <div class="col-lg-8">
                                        <input class="form-control" name="passwort_alt" type="password"
                                               placeholder="Gib hier dein altes Passwort ein."
                                               required>
                                    </div>
                                </div>
                                <p></p>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Neues Passwort</label>

                                    <div class="col-lg-8">
                                        <input class="form-control" name="passwort" type="password"
                                               placeholder="Gib hier dein neues Wunschpasswort ein." required>
                                    </div>
                                </div>
                                <p></p>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Neues Passwort wiederholen</label>

                                    <div class="col-lg-8">
                                        <input class="form-control" name="passwort2" type="password"
                                               placeholder="Bitte wiederhole dein Wunschpasswort."
                                               required>
                                    </div>
                                </div>
                                <div class="button-container col-md-offset-4">
                                    <button class="sweep" type="" name="submitdata">Passwort ändern</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<br><br>



 <?php
include("connection.php");
$directorywert = md5($_SESSION['email']);
$dir = "uploads/$directorywert/";


$arrayy[] = (scandir($dir));
print_r(array_values($arrayy));
foreach ($arrayy as $datei){
if ($file != "." && $file != "..") {
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    $size = filesize($dir . $file);
    $prettysize = readablesize($size);
    $placeoffile = ($dir . $file);

    echo("
                            <tr class='active'>
                            <td><a href='$placeoffile'>$file </a></td>
                            <td>$extension</td>
                            <td>$prettysize</td>
                            <td>$placeoffile</td>
                            <td><a><i id=$placeoffile class='ui-icon-info'></i></a></td>
                            <td><a href='#myModal' data-toggle=\"modal\"><i id=$placeoffile class='share fa fa-share'></i></a></td>
                            <td><a><i id=$placeoffile class='delete fa fa-trash'></i></a></td>
                            </tr>");
}
}
?>

</body>
</html>