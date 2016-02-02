<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
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


<div class="card hovercard">
    <div class="cardheader"></div>
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
    </div>

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
                            <button class="sweep" type="submit" name="submitdata">Passwort ändern</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>


<div class="footer">
    <small class="credits col-md-offset-2">Credits 2015 @Team OMM</small>
    <small class="impressum col-md-offset-6"><a href="#">Impressum</a></small>
    <div class="footer-container">
        <div class="footer-float">
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Download</a></li>
                <li><a href="#">Support</a></li>
            </ul>
        </div>

        <div class="footer-float">
            <ul>
                <li>Impressum</li>
                <li>AGB</li>
            </ul>
        </div>

        <div class="footer-float">
            <ul>
                <li><a href="#"><i class="social facebook fa fa-facebook fa-3x"></i></a></li>
                <li><a href="#"><i class="social twitter fa fa-twitter fa-3x"></i></a></li>
                <li><a href="#"><i class="social youtube fa fa-youtube-play fa-3x"></i></a></li>
            </ul>
        </div>
    </div>

</div>


</body>
</html>