<?php
include("Connection.php");
include("Functions.php");

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>  
    <header>
    <div class="menu">
         <ul>
            <img class="logo" src="../Fotos/logo_timothy.png"/>
            <li><a class="fa fa-shopping-cart" href="winkelwagenn.php" style="font-size:24px"></a></li>
            <li><a href="Inlogpagina.php">login</a></li>

            <li><a href="Bestellingenoverzicht.php">Besteloverzicht</a></li>
<?php
            if(isset($_SESSION) && $_SESSION['email'] != ''){
                echo '<li><a href="winkelwagenn.php">Besteloverzicht</a></li>
                        <li><a href="Inlogpagina.php">login</a></li>';
                echo 'kaas';
                // ingelogd, toon geheime content
                echo '<li><a href="loguit.php">loguit</a></li>';

            }else{
                echo 'koe';
                // niet ingelogd.
            }
?>
        </ul>
    </div>
    </header>
</body>
</html>