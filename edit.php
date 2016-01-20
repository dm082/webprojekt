<?php
// Session starten
session_start ();

// Datenbankverbindung aufbauen
include ("connection.php");

//Passwortvergleich (eingegebenes PW mit dem der DB)

$email = $_POST["email"];
$passwort_alt = $_POST["passwort_alt"];

try{
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
$salted_password = $secret_salt . $passwort_alt;
$password_hash = hash('sha256', $salted_password);

if($pwvergleich == $password_hash)
{
    $_SESSION["email"] = $email;
    $_SESSION["loggedin"] = 1;
    echo "Passwoerter stimmen &uuml;berein.";
    $error = false;
}
else
{
    echo "Das eingegebene alte Passwort stimmt nicht.";
    $error = true;
}


// neues Passwort einspeichern


$pw = $_POST["passwort"];
$pw2 = $_POST["passwort2"];
$user_dir = md5($_POST["email"]); /* Es wird auf Basis der einmaligen E-Mail ein Hashwert erzeugt*/

if ($error == false) {
    if ($pw == $pw2) {


        $pw = $_POST["passwort"];
        $secret_salt = "topsecretsalt";
        $salted_password = $secret_salt . $pw;
        $password_hash = hash('sha256', $salted_password);

        //Einfügen in DB

        $edit = $db->prepare('UPDATE User SET passwort = :passwort WHERE email = :email');
        $array = array(
            ':passwort' => $password_hash,
            ':email' => $_SESSION['email']
        );

        $edit->execute($array);

        echo "Ihr Passwort wurde erfolgreich ge&aandert <br /> ";
        echo "<a href='loginsite.html'>Einloggen</a><br/>";
        echo $password_hash;
    } else {
        echo "Die Passw&ouml;rter waren nicht identisch. <a href='index.html'>Zur&uuml;ck</a>";
    }
}
else {}

$db     = null;
/*header("Location: index.html");*/
die();
?>
