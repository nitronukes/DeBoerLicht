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

function Filteren($conn) 
{
    $stmt = $conn->prepare("SELECT Categorie FROM categorieen");
    $stmt->execute();
    $sql = $stmt->get_result();

    foreach ($sql as $row) {
        echo"
            <option value='Lampenoverzicht.php?filter=" . $row['Categorie'] . "'> $row[Categorie] </option>
        ";
    }
}