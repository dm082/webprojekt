<!DOCTYPE html>
<head>
    <link href="css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-editable.min.js"></script>
    <meta charset="UTF-8">
</head>
<body>

<?php
// Session starten
session_start ();

// Datenbankverbindung aufbauen
 include ("connection.php");

$email = $_POST["email"];
$passwort = $_POST["passwort"];

try{
 //   include_once("userdata.php");
 //   $db = new PDO($dsn, $db_user, $db_pass);
    $sql = "SELECT email, passwort FROM User WHERE email LIKE '$email'";

    $query = $db->prepare($sql);
    $query->execute();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)){
        $emailvergleich = $result["email"];
        $pwvergleich = $result["passwort"];
    }

}
catch(PDOException $e){
    echo "2:".$sql."</br>".$e->getMessage();
    die();
}

$secret_salt = "topsecretsalt";
$salted_password = $secret_salt . $passwort;
$password_hash = hash('sha256', $salted_password);

if($pwvergleich == $password_hash)
{
    $_SESSION["email"] = $email;
    $_SESSION["loggedin"] = 1;
       echo "Login erfolgreich.. <br> <a href='uploadseitee.html' >Zum Upload</a>";
        header('Location: showuploads.php');
}
else
{
    $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    //echo "Benutzername und/oder Passwort falsch.</br>";
    //echo "Zur&uuml;ck zur <a href='loginsite.html'>Anmeldeseite</a><br/>";
}

?>
<!--<script type = "text/javascript">
    $(function(){
        $(".close").click(function(){
            $("#myAlert").alert('close');
        });
    });
</script>

</body>
</hml>

