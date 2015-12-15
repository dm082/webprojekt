<?php
session_start();     //Session starten
?>

<?php
//include_once ("connection.php");   //DB Verbindung herstellen
include_once("userdata.php");
$db = new PDO($dsn, $db_user, $db_pass);

$pw = $_POST["passwort"];
$pw2 = $_POST["passwort2"];


if ($pw == $pw2)
    {
        //$user_vorhanden = array();
        //$passwort = md5($password);

        $pw = $_POST["passwort"];
        $secret_salt = "topsecretsalt";
        $salted_password = $secret_salt . $pw;
        $password_hash = hash('sha256', $salted_password);

        echo "Gl&uuml;ckwunsch zur Registrierung";
    }

    else
    {
        echo "Die Passw&ouml;rter waren nicht identisch. <a href='index.html'>Zur&uuml;ck</a>";
    }

// query
$sql = "INSERT INTO User (vorname, nachname, email, passwort, passwort2) VALUES (:vorname,:nachname,:email,:passwort,:passwort2)";
$query = $db->prepare($sql);
$query->execute(
    array(
        ':vorname'=>$_POST["vorname"],
        ':nachname'=>$_POST["nachname"],
        ':email'=>$_POST["email"],
        ':passwort'=> $password_hash,
        ':passwort2'=> $password_hash,
    )


);


$db     = null;
/*header("Location: index.html");*/
die();
?>

<!-- für das Login: http://www.foxplex.com/sites/php-passwoerter-sicher-verschluesseln/
http://www.webmasterpro.de/coding/article/php-sicherheit-passwoerter-sicher-speichern.html-->
