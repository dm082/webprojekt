<!DOCTYPE html>
<html lang="en">
<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href="main.css" rel="stylesheet">
    <script src="./js/dropzone.js"></script>
    <link href="./css/basic.css" rel="stylesheet">
    <link href="./css/dropzone.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Happy Times</title>
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

<br/><br/>
<br/><br/>
<br/><br/>


</body>
</html>



<html>

<h3 class="col-md-offset-4" >Mein Profil </h3>
<hr>

<?php

include ("profilausgabe.php");

?>



    <?php
    include ('connection.php');
    $einfuegen = $db->prepare('SELECT * FROM User WHERE email = :email');
    $array = array(
        ':email' => $_SESSION['email']
    );
    $einfuegen->execute($array);


    while ($row = $einfuegen->fetch()) {
        echo "<img src='" . $row['profilbildpfad'] . "'>";
    };
    ?>

    <div id="upload" >
        <form action="profilfoto.php" method="post" enctype="multipart/form-data">
            Bild: <input type="file" name="bild"> <input type="submit" name="upload" value="Hochladen">
        </form>

    </div>


<h3 class="col-md-offset-4" >Mein Passwort ändern </h3>

<form class="form-horizontal" role="form" action="edit.php" method="post">
    <div class="form-group">
        <label class="col-lg-3 control-label">Altes Passwort </label>
        <div class="col-lg-5">
            <input class="form-control" name="passwort_alt" type="text" value="Gib hier dein altes Passwort ein.">
        </div>
    </div>
    <p></p>
    <div class="form-group">
        <label class="col-lg-3 control-label">Neues Passwort</label>
        <div class="col-lg-5">
            <input class="form-control" name="passwort" type="text" value="Gib hier dein neues Wunschpasswort ein.">
        </div>
    </div>
    <p></p>
    <div class="form-group">
        <label class="col-lg-3 control-label">Neues Passwort wiederholen</label>
        <div class="col-lg-5">
            <input class="form-control" name="passwort2" type="text" value="Bitte wiederhole dein Wunschpasswort.">
        </div>
    </div>
    <div class="button-container col-md-offset-4">
        <button class="sweep" type="" name="submitdata">Passwort ändern</button>
    </div>
</form>

</html>