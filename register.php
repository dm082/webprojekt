<?php
session_start();     //Session starten



include_once ("connection.php");   //DB Verbindung herstellen
// include_once("userdata.php");
// $db = new PDO($dsn, $db_user, $db_pass);


$pw = $_POST["passwort"];
$pw2 = $_POST["passwort2"];
$user_dir = md5($_POST["email"]); /* Es wird auf Basis der einmalige EMail ein Hashwert erzeugt*/

if ($pw == $pw2)
    {


        $pw = $_POST["passwort"];
        $secret_salt = "topsecretsalt";
        $salted_password = $secret_salt . $pw;
        $password_hash = hash('sha256', $salted_password);
        $profilbildpfad = "http://placehold.it/200x200";

        echo "Gl&uuml;ckwunsch zur Registrierung <br /> ";
        echo "<a href='loginsite.html'>Einloggen</a><br/>";

        /*Es wird gecheckt ob der neue Ordner, bestehend aus dem Hashwert der Email bereits existiert
        (Sehr unwarscheinlich) -> Falls es keinen gibt, wird einer erstellt */
        if(!is_dir("uploads/$user_dir"))
        {
            mkdir("uploads/$user_dir", 0777, true);
        }
        else
        {
            echo "Weiter zu ihrem Ordner";
        }

        // Hier  wird die query ausgef�hrt und die Variablen in der Datenbank gespeichert.
        $sql = "INSERT INTO User (vorname, nachname, email, passwort, passwort2, pfad, profilbildpfad) VALUES (:vorname,:nachname,:email,:passwort,:passwort2, :pfad, :profilbildpfad)";
        $query = $db->prepare($sql);
        $query->execute(
            array(
                ':vorname'=>$_POST["vorname"],
                ':nachname'=>$_POST["nachname"],
                ':email'=>$_POST["email"],
                ':passwort'=> $password_hash,
                ':passwort2'=> $password_hash,
                ':pfad' => $user_dir,
                ':profilbildpfad' => $profilbildpfad,

            )
        );
    }
    else
    {
        echo "Die Passw&ouml;rter waren nicht identisch. <a href='index.html'>Zur&uuml;ck</a>";
    }


$db     = null;
/*header("Location: index.html");*/
die();
?>

