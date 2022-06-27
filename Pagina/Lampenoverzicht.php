<?php 
require_once('header.php');
$categorie = $_GET['filter'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lampenoverzicht</title>
</head>
<body>
    <div class="Lampenoverzichtpaginagrid">
    <div class="Lampenoverzichtpaginatop"></div>
    <div class="Lampenoverzichtpaginalinks"></div>
    <div class="Lampenoverzichtpaginarechts"></div>
    <div class="Lampenoverzichtfilteren">
        <h2 class="h2overzicht">Filteren</h2>
        <select onchange="location = this.value; value=' <?php $categorie ?>'">
            <?php
                if ($categorie == 'Geencategorie') {
                    echo"
                    <option value='Lampenoverzicht.php?filter=Geencategorie' selected>Geen categorie</option>
                    ";
                }
                else {
                    echo"
                    <option value='Lampenoverzicht.php?filter=Geencategorie'>Geen categorie</option>
                    ";
                }
                Filteren($conn, $categorie);
            ?>

        </select>
    </div>
    <div class="Lampenoverzichtgrid">
        <?php 
            Lampenoverzicht($conn, $categorie);
        ?>
    </div>
    </div>
</body>
</html>
