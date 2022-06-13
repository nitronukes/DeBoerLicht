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

function Producttoevoegen($conn, $Productnaam, $Prijs, $korting, $categorie, $beschrijving, $voorraad, $foto)
{
    $CategorieID = $conn->prepare("SELECT CategorieID FROM `categorieen` WHERE 'Categorie' = ?");
    $CategorieID->bind_param('s', $categorie);
    
    $stmt2 = "INSERT INTO `producten` (`Categorie_ID`, `ProductNaam`, `Prijs`, `Korting`, `Beschikbaar`, `Tekst`) VALUES (?,?,?,?,?,?)";
    $stmt2 = mysqli_prepare($conn, $stmt2);
    mysqli_stmt_bind_param($stmt2, 'isiiis', $CategorieID, $Productnaam, $Prijs, $korting, $voorraad, $beschrijving); //Bind param
    mysqli_stmt_execute($stmt2); //Uitvoeren


}
