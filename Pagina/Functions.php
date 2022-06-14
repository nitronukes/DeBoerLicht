<?php

function Lampenoverzicht($conn, $categorie)
{
    //$stmt = $conn->prepare("SELECT * FROM categorieen INNER JOIN producten ON categorieen.CategorieID = producten.Categorie_ID /*INNER JOIN productfoto ON producten.ID = productfoto.ProductID*/ WHERE categorieen.Categorie = ?");
    $stmt = $conn->prepare("SELECT * FROM categorieen INNER JOIN producten ON categorieen.CategorieID = producten.Categorie_ID");

     if ($categorie != 'Geencategorie' ) {
        $stmt = $conn->prepare("SELECT * FROM categorieen INNER JOIN producten ON categorieen.CategorieID = producten.Categorie_ID WHERE categorieen.Categorie = ?");
        $stmt->bind_param('s', $categorie);
     }

    $stmt->execute();
    $sql = $stmt->get_result();

    foreach ($sql as $row) {
         echo "
             <div>
             $row[ProductNaam]
             
             </div>";
    }   
} 

function Filteren($conn, $categorie) 
{
    $stmt = $conn->prepare("SELECT Categorie FROM categorieen");
    $stmt->execute();
    $sql = $stmt->get_result();

    foreach ($sql as $row) {
        
        if ($categorie == $row['Categorie']) {
            echo"
                <option value='Lampenoverzicht.php?filter=" . $row['Categorie'] . "' selected> $row[Categorie] </option>
            ";
        }
        else {
            echo"
            <option value='Lampenoverzicht.php?filter=" . $row['Categorie'] . "'> $row[Categorie] </option>
        ";
        }
    }
}

function Inloggen($conn, $email, $wachtwoord)
{
    $sql = "SELECT * FROM `users` WHERE `email` = '".$email."' AND `password` = '".$wachtwoord."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $_SESSION['email'] = $email;
            header("location:Bestellingenoverzicht.php");
            exit();
          }
    else
    {
        echo  "<script>alert('Het e-mail adres of wachtwoord in incorrect')</script>";
    }
    $conn->close();
}

function Producttoevoegen($conn, $Productnaam, $Prijs, $korting, $categorie, $beschrijving, $voorraad, $files)
{
    $stmt2 = "INSERT INTO `producten` (`Categorie_ID`, `ProductNaam`, `Prijs`, `Korting`, `Beschikbaar`, `Tekst`) VALUES (?,?,?,?,?,?)";
    $stmt2 = mysqli_prepare($conn, $stmt2);
    $stmt2->bind_param('dsiiis', $CategorieID, $Productnaam, $Prijs, $korting, $voorraad, $beschrijving);
    $stmt2->execute();
    var_dump($files);
    $target_dir = "Fotos/";
    $target_file = $target_dir . basename($files["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if(isset($_POST["submit"])) {
        $check = getimagesize($files["fileToUpload"]["tmp_name"]);
        if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
          echo "File is not an image.";
          $uploadOk = 0;
        }
      }
    if($imageFileType != "png") {
        echo "Je kan alleen png files gebruiken";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, je foto is niet geüpload";
      } else {
        if (move_uploaded_file($files["fileToUpload"]["tmp_name"], $target_file)) {
          echo "The file ". htmlspecialchars( basename( $files["fileToUpload"]["name"])). " has been uploaded.";
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
      }

}

function CategorieToevoeg($conn)
{
    $stmt = $conn->prepare("SELECT Categorie FROM categorieen");
    $stmt->execute();
    $sql = $stmt->get_result();

    foreach ($sql as $row) {
        echo"
            <option value=' $row[CategorieID]' selected> $row[Categorie] </option>
        ";
        
    }
}