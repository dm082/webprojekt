<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 17.12.2015
 * Time: 19:11
 */

/**
$_FILES['userfile']['name']

    The original name of the file on the client machine.
$_FILES['userfile']['type']

The mime type of the file, if the browser provided this information. An example would be "image/gif".
 * This mime type is however not checked on the PHP side and therefore don't take its value for granted.
$_FILES['userfile']['size']

    The size, in bytes, of the uploaded file.
$_FILES['userfile']['tmp_name']

    The temporary filename of the file in which the uploaded file was stored on the server.
$_FILES['userfile']['error']
    The error code associated with this file upload.
 * */

$target_dir = 'uploads/';
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image


// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 524288000) {
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
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>