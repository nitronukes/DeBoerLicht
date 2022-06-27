<?php
if (!isset($_SESSION)) {
    session_start();
}

function Lampenoverzicht($conn, $categorie)
{
    //$stmt = $conn->prepare("SELECT * FROM categorieen INNER JOIN producten ON categorieen.CategorieID = producten.Categorie_ID /*INNER JOIN productfoto ON producten.ID = productfoto.ProductID*/ WHERE categorieen.Categorie = ?");
    $stmt = $conn->prepare("SELECT * FROM categorieen INNER JOIN producten ON categorieen.CategorieID = producten.Categorie_ID INNER JOIN productfoto ON producten.ID = productfoto.ProductID GROUP BY productfoto.ProductID");

    if ($categorie != 'Geencategorie') {
        $stmt = $conn->prepare("SELECT * FROM categorieen INNER JOIN producten ON categorieen.CategorieID = producten.Categorie_ID INNER JOIN productfoto ON producten.ID = productfoto.ProductID WHERE categorieen.Categorie = ? GROUP BY productfoto.ProductID");
        $stmt->bind_param('s', $categorie);
    }

    $stmt->execute();
    $sql = $stmt->get_result();
    $sql = $sql->fetch_all();



    foreach ($sql as $row) {
        echo "
             <div class='lampoverzichtachtergrond'>
             <form class='productlampoverzicht' method='post' action='Productpagina.php?lamp=" . $row[2] . "'>
             <img class='Lampenoverzichtfotos' src='$row[11]' alt='$row[4]'>
                <input type='submit' value='$row[4]' class='Lampenoverzichtbutton'/>
            </form>
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
            echo "
                <option value='Lampenoverzicht.php?filter=" . $row['Categorie'] . "' selected> $row[Categorie] </option>
            ";
        } else {
            echo "
            <option value='Lampenoverzicht.php?filter=" . $row['Categorie'] . "'> $row[Categorie] </option>
        ";
        }
    }
}

function Inloggen($conn, $email, $wachtwoord)
{
    $sql = "SELECT * FROM `users` WHERE `email` = '" . $email . "' AND `password` = '" . $wachtwoord . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        header("location:Bestellingenoverzicht.php");
        exit();
    } else {
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

$categorie = 5;
    $stmt2 = $conn->prepare("INSERT INTO `producten` (`Categorie_ID`, `ProductNaam`, `Prijs`, `Korting`, `Beschikbaar`, `Tekst`) VALUES (?,?,?,?,?,?)");
    $stmt2->bind_param('isiiis', $categorie, $Productnaam, $Prijs, $korting, $voorraad, $beschrijving);
    $stmt2->execute();

    // if (isset($stmt2)){
    //     echo"Statement werkt";
    //     echo $categorie . "pizza";
    //     echo $stmt2;
    // }
    $lastInsertId = $conn->insert_id;

    $stmt2->close();

    if (isset($errors)) {
        var_dump($errors);
        exit();
    }

    foreach ($filenamesToSave as $filename) {

        $sql = 'INSERT INTO productfoto (ProductID,Foto) VALUES (?, ?)';

        $statement = $conn->prepare($sql);

        $statement->bind_param('is', $lastInsertId, $filename);

        $statement->execute();

        $statement->close();
    }

    $conn->close();
}

function CategorieToevoegpagina($conn)
{
    $stmt = $conn->prepare("SELECT Categorie FROM categorieen");
    $stmt->execute();
    $sql = $stmt->get_result();

    foreach ($sql as $row) {
        echo "
            <option name='categorie' value=' $row[CategorieID]' selected> $row[Categorie] </option>
        ";
    }
}

function Lamptonen($conn, $lamp)
{
    $Currentforeach = 1;
    //$stmt = $conn->prepare("SELECT * FROM producten INNER JOIN productfoto ON producten.ID = productfoto.ProductID WHERE producten.ProductNaam = ?");
    $stmt = $conn->prepare("SELECT * FROM producten WHERE ID = ?");
    $stmt->bind_param('i', $lamp);
    $stmt->execute();
    $sql = $stmt->get_result();
    $sql = $sql->fetch_all();
    $stmt->close();

    $stmt = $conn->prepare("SELECT * FROM productfoto WHERE ProductID = ?");
    $stmt->bind_param('i', $lamp);
    $stmt->execute();

    $sql2 = $stmt->get_result();
    $sql2 = $sql2->fetch_all();
    $stmt->close();

    //return $stmt;



    foreach ($sql as $row) {

        echo '
        <div class="Productnaam">' . $row[2] . '</div>
        <div class="producttekst">' . $row[6] . '</div>
        <div class="productprijs"> € ' . $row[3] . '</div>
        <div class="productvoorraad">' . $row[5] . ' stuks op voorraad</div>
        <div class="productAantal"> 1 </div>
        <div class="productwinkelmandtoevoeg">  </div>
        <div class="ProductSlideShow">
        <div class="slideshow-container">
        
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>';

        foreach ($sql2 as $row2) {

            echo ' 
            <div class="mySlides fade">
            <img src="' . $row2[2] . '" style="width: 80%">
            </div>
            ';
        }
        echo '<div class="dotalign">';
        foreach ($sql2 as $row2) {
            echo '
            
            <span class="dot" onclick="currentSlide(' . $Currentforeach . ')"></span>
            
            ';
            $Currentforeach++;
        }

        echo "</div> </div>";
    }
}

function CategorieUpdate($conn, $categorie, $ID)
{
    $stmt = $conn->prepare("UPDATE `categorieen` SET `Categorie` = ? WHERE CategorieID = ?");
    $stmt->bind_param('si', $categorie, $ID);
    $stmt->execute();
}

function CategorieTonen($conn)
{
    $stmt = $conn->prepare("SELECT * FROM categorieen");
    $stmt->execute();
    $sql = $stmt->get_result();
    $sql = $sql->fetch_all();

    foreach ($sql as $row) {
        echo "
            <tr>
                <form action='#' method='POST' class='d-inline'>    
                    <td> 
                        <Input class='Inputpaginas' value='$row[1]' name='Categorie' placeholder='" . $row[1] . "'></Input>
                    </td>
                <td>
                        <button name='CategorieID' type='submit' value='" . $row[0] . "' class='btn btn-success btn-sm'><strong> Categore wijzigen</strong></button>
                </form>
                <form action='Categoriebeheer.php?deleteID=$row[0]' method='POST' class='d-inline'>
                    <button type='submit' name='' value='" . $row[0] . "' class='btn btn-danger btn-sm' onclick='window.location.href=''>Verwijder</button>                                                    
                </form>
                </td>
            </tr>
        ";
    }
}

function CategorieVerwijderen($conn, $ID)
{
    echo $ID;
    $stmt1 = $conn->prepare("SELECT ID FROM producten WHERE Categorie_ID = ?");
    $stmt1->bind_param('s', $ID);
    $stmt1->execute();
    $stmt1->close();

    if (isset($stmt)) {
        foreach ($stmt1 as $row) {

            $stmt2 = $conn->prepare("DELETE FROM productfoto WHERE ProductID = ?");
            $stmt2->bind_param('s', $stmt1);
            $stmt2->execute();
            $stmt2->close();
        }

        $stmt3 = $conn->prepare("DELETE FROM producten WHERE Categorie_ID = ?");
        $stmt3->bind_param('s', $ID);
        $stmt3->execute();
        $stmt3->close();
    }

    $stmt4 = $conn->prepare("DELETE FROM categorieen WHERE CategorieID = ?");
    $stmt4->bind_param('s', $ID);
    $stmt4->execute();
    $stmt4->close();
}

function CategorieToevoegen($conn)
{
    echo "
            <tr>
                <form action='#' method='POST' class='d-inline'>    
                    <td> 
                        <Input class='Inputpaginas' value='' name='Categorienaam' placeholder='Categorienaam'></Input>
                    </td>
                    <td>
                        <button name='CategorieID' type='submit' value='Categorienaam' class='btn btn-success btn-sm'><strong> Categore toevoegen</strong></button>
                    </td>
                </form>
            </tr>
        ";
}


function gridhomepaginatestphptesthome($conn)
{
$stmt = $conn->prepare("SELECT * FROM producten INNER JOIN productfoto ON producten.ID = productfoto.ProductID WHERE producten.Korting > 0 GROUP BY productfoto.ProductID ORDER BY Korting DESC LIMIT 4;");

    $stmt->execute();
    $sql = $stmt->get_result();
    $sql = $sql->fetch_all();



    foreach ($sql as $row) {
        echo "<div>
     <form method='post' action='Productpagina.php?lamp=" . $row[0] . "'>
     <img class='Lampenoverzichtfotos' src='$row[9]''>
        <input type='submit' value='$row[4]% korting' class='indexknop'/>
    </form>
    </div>";
    }
}
