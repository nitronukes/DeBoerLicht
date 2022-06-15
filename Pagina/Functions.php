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

function 

Inloggen($conn, $email, $wachtwoord)
{
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `email` = ? AND `password` = ?");
    $stmt->bind_param('ss', $email, $wachtwoord);

    $result = $conn->query($stmt);
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

    $_FILES = $files;

    if (!is_dir('../Fotos')) {
        mkdir('../Fotos', 0777, true);
    }

    $filenamesToSave = [];

    $allowedMimeTypes = explode(',', "image/png, image/jpg, image/jpeg");

    if (!empty($_FILES)) {
        if (isset($_FILES['file']['error'])) {
            foreach ($_FILES['file']['error'] as $uploadedFileKey => $uploadedFileError) {
                if ($uploadedFileError === UPLOAD_ERR_NO_FILE) {
                    $errors[] = 'Er is geen foto meegegeven';
                } elseif ($uploadedFileError === UPLOAD_ERR_OK) {
                    $uploadedFileName = basename($_FILES['file']['name'][$uploadedFileKey]);

                    if ($_FILES['file']['size'][$uploadedFileKey] <= 50000000000) {
                        $uploadedFileType = $_FILES['file']['type'][$uploadedFileKey];
                        $uploadedFileTempName = $_FILES['file']['tmp_name'][$uploadedFileKey];

                        $uploadedFilePath = rtrim('../Fotos', '/') . '/' . $uploadedFileName;

                        if (in_array($uploadedFileType, $allowedMimeTypes)) {
                            if (!move_uploaded_file($uploadedFileTempName, $uploadedFilePath)) {
                                $errors[] = 'Het bestand "' . $uploadedFileName . '" kon niet worden geupload';
                            } else {
                                $filenamesToSave[] = $uploadedFilePath;
                            }
                        } else {
                            $errors[] = 'Ongeldig bestandstype "' . $uploadedFileName . '" . Wel geldig: JPG, JPEG, PNG, or GIF.';
                        }
                    } else {
                        $errors[] = 'Het bestand van "' . $uploadedFileName . '" moet maximaal zijn: ' . (5000000000 / 1024) . ' KB';
                    }
                }
            }
        }
    }
    $categorie = 2;
    

    $stmt2 = $conn->prepare("INSERT INTO `producten` (`Categorie_ID`, `ProductNaam`, `Prijs`, `Korting`, `Beschikbaar`, `Tekst`) VALUES (?,?,?,?,?,?)");
    $stmt2->bind_param('isiiis', $categorie, $Productnaam, $Prijs, $korting, $voorraad, $beschrijving);
    $stmt2->execute();

    $lastInsertId = $conn->insert_id;

    $stmt2->close();

    if (isset($errors)) {
        var_dump($errors);
        exit();
    }

    foreach ($filenamesToSave as $filename) {

        $sql = 'INSERT INTO productfoto (
                            ProductID,
                            Foto
                            ) VALUES (
                            ?, ?
                            )';

        $statement = $conn->prepare($sql);

        $statement->bind_param('is', $lastInsertId, $filename);

        $statement->execute();

        $statement->close();
    }

    $conn->close();

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