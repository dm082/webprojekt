<?php
session_start();

// Email Wert wird verhasht um "anonyme" Ordner zu erhalten
$directorywert = md5($_SESSION['email']);

// Dateien werden in den jeweiligen Ordner basierend auf dem Email Hash abgelegt
$target_dir = "uploads/$directorywert/";
// Mithilfe von preg_replace werden ung�ltige Zeichen, die zu Problemen f�hren k�nnen, ersetzt.
$olduserfile = $_FILES["file"]["name"];
$middleuserfile = preg_replace ("([^\w\s\d\-_~,;:\[\]\(\).])", '', $olduserfile);
$newuserfile = preg_replace('/\s+/', '_', $middleuserfile);


$target_file = $target_dir . basename($newuserfile);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image



// Check if file already exists
if (file_exists($target_file)) {
    echo "The file already exists.<br/>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["file"]["size"] > 13107200) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}


//------------------------------- Allow certain file formats-------------------------------------------
/**
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
//------------------------------- END allow file formats-------------------------------------------*/


//------------------------------- Check if $uploadOk is set to 0 by an error ------------------------
if ($uploadOk == 0) {
    echo "Therefore, your file was not uploaded.<br/>";
    echo "View your <a href='showuploads.php'>files</a>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". basename($olduserfile). " has been uploaded.<br/>";
        echo "View your <a href='showuploads.php'>files</a>";
    } else {
        echo "Sorry, there was an error uploading your file.<br/>";
        echo "View your <a href='showuploads.php'>files</a>";
    }
}
?>