<?php
// Session starten
session_start ();

// Datenbankverbindung aufbauen
include ("connection.php");

$email = $_POST["email"];
$passwort = $_POST["passwort"];    //muss hier was verhashtes rein???

    $sqlabfrage = "SELECT email, passwort FROM user WHERE email LIKE '$email'";
    $ergebnis = $db->query($sqlabfrage);
    while($row = $ergebnis->fetch(PDO::FETCH_ASSOC)) {
        echo $row['name'].'/'.$row['email'].'<br/>';      //muss noch umgeschrieben werden -- Siehe seine Folien php Grundlagen

    }

// if($row->passwort == $passwort)
// {
//   $_SESSION["email"] = $email;
//        echo "Login erfolgreich."
//}
//else
//{
//    echo "Benutzername und/oder Passwort falsch."
//}

?>
 