<?php
include 'Functions.php';
include 'Connection.php';

if(isset($_GET['lamp'])){
    $id = $_GET['lamp'];
}

 
if (!isset($_SESSION)) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Styles.css">
    <title>LichtenToevoegen</title>
</head>
<body>
    <a class="verlaattoevoeglamp" href="Lampenoverzicht.php?filter=Geencategorie   ">&times</a>
    <form action="../Handlers/Lamptoevoeg.php" method="post" enctype="multipart/form-data">
    <div class="Toevoegmodal" id="modal">
        <div class="Toevoegmodal-body">
            <div class="Toevoegmodallinks"></div>
            <div class="Toevoegmodalrechts"></div>
            <div><input type="text" name="ProductNaam" class="ProductnaamToevoeg" placeholder="Productnaam" required> </div>
            <div><input type="number" name="Prijs" class="PrijsToevoeg" placeholder="Prijs" min="1" required> </div>
            <div><input type="number" name="KortingToevoeg" class="KortingToevoeg" placeholder="Korting" min="0" max="100" required> </div>
            <div><select class="CategorieToevoeg" name="categorie" id="categorie" required>
            <?php
                
                CategorieToevoegpagina($conn);
                ?>
                 </select> </div>
            <div><input type="text" name="Beschrijving" class="BeschrijvingToevoeg" placeholder="Beschrijving" required> </div>
            <div><input type="number" name="Voorraad" class="VoorraadToevoeg" placeholder="Voorraad" min="0" required> </div>
            <div><input type="file" and accept="image/*" name="file[]" class="BestandToevoeg" placeholder="Foto Toevoegen" id="fileToUpload" required multiple> </div>
            <div><button type="submit" name="submit" class="knoptoevoegmodal">Product toevoegen</button> </div>
        </div>
    </div>
</form>
</body>
</html>
<?php

// if(isset($_POST['submit']))
// {
//     $ProductNaam = $_POST['ProductNaam'];
//     $Prijs = $_POST['Prijs'];
//     $Korting = $_POST['KortingToevoeg'];
//     $CategorieID = $_POST['categorie'];
//     $Tekst = $_POST['Beschrijving'];
//     $Beschikbaar = $_POST['Voorraad'];
//     $Foto = $_POST['foto'];

//     $sql = "INSERT INTO producten (ProductNaam,Prijs,Kortingtoevoeg,categorie,Beschrijving,Voorraad,Foto)
//      VALUES ('$ProductNaam', '$Prijs', '$Korting', '$CategorieID', '$Tekst', '$Beschikbaar', '$Foto')";
//      if (mysqli_query($conn, $sql)){
//          echo"jemoeder";
//      } else {
//          echo "Fout: " . $sql . "
//          " . mysqli_error($conn);
//      }
//      mysqli_close($conn);
// }
?>