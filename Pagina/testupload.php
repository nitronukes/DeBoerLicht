<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
    <div><input type="file" and accept="image/*" name="fileToUpload" class="BestandToevoeg" placeholder="Foto Toevoegen" id="fileToUpload" required multiple> </div>
    <div><button type="submit" name="submit" class="knoptoevoegmodal">Product toevoegen</button> </div>
    </form>
</body>
</html>




<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    var_dump($_FILES);

    // $target_dir = "Fotos/";
    // define ('SITE_ROOT', realpath(dirname(__FILE__)));
    // move_uploaded_file($_FILES['fileToUpload']['tmp_name'], SITE_ROOT.'Fotos/');
    // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    // $uploadOk = 1;
    // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // if(isset($_POST["submit"])) {
    //     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    //     if($check !== false) {
    //       echo "File is an image - " . $check["mime"] . ".";
    //       $uploadOk = 1;
    //     } else {
    //       echo "File is not an image.";
    //       $uploadOk = 0;
    //     }
    //   }


}