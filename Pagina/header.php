<?php
include("Connection.php");
include("Functions.php");



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>  
    <header>
    <div class="menu">
         <ul>
            <img class="logo" src="../Fotos/logo_timothy.png"/>




<?php
            if(isset($_SESSION) && isset($_SESSION['email']) != ''){
                echo '
                <li><a href="loguit.php">loguit</a></li>
                <li><a href="Lampenoverzicht.php?filter=Geencategorie">lampen</a></li>
                <li><a href="Bestellingenoverzicht.php">Besteloverzicht</a></li>
                <li><a href="Productbeheer.php">Productbeheer</a></li>
                <li><a href="Categoriebeheer.php">Categoriebeheer</a></li>
                <li><a href="index.php">home</a> </li>
                ';

            }else{
                echo '
                        <li><a class="fa fa-shopping-cart" href="winkelwagenn.php" style="font-size:16px"></a></li>
                        <li><a href="Inlogpagina.php">login</a></li>
                        <li><a href="Lampenoverzicht.php?filter=Geencategorie">lampen</a></li>
                        <li><a href="index.php">home</a> </li>
                        
                        ';
            }
?>


        </ul>
    </div>
    </header>
</body>
</html>