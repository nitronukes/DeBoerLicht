<?php
require_once('header.php');
$categorie = $_GET['filter'];
if (isset($_GET['deleteID'])){
    $productID = $_GET['deleteID'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Styles.css">
    <script src="https://kit.fontawesome.com/b5d173f5c2.js" crossorigin="anonymous"></script>
    <title>Lampenoverzicht</title>
    <link rel="stylesheet" href="../css/Styles.css">
</head>

<body>
    <div class="Lampenoverzichtpaginagrid">
    <div class="Lampenoverzichtpaginatop"></div>
    <div class="Lampenoverzichtpaginalinks"></div>
    <div class="Lampenoverzichtpaginarechts"></div>
    <div class="Lampenoverzichtfilteren">
        <h2 class="h2overzicht">Filteren</h2>
        <select class="categorieuitzoeken" onchange="location = this.value; value=' <?php $categorie ?>'">
            <?php
                if ($categorie == 'Geencategorie') {
                    echo "
                    <option value='Lampenoverzicht.php?filter=Geencategorie' selected>Geen categorie</option>
                    ";
                } else {
                    echo "
                    <option value='Lampenoverzicht.php?filter=Geencategorie'>Geen categorie</option>
                    ";
                }
                Filteren($conn, $categorie);
                ?>

            </select>
        </div>
        <div class="Lampenoverzichtgrid">
            <?php
            if (isset($productID)) {
                DeleteProduct($conn, $productID);
            }
            Lampenoverzicht($conn, $categorie);
            ?>
        </div>
    </div>
</body>

</html>