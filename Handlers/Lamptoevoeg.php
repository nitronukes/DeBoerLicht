<?php
include '../Pagina/Connection.php';
include '../Pagina/Functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' & $_POST['KortingToevoeg'] <=100 & $_POST['KortingToevoeg'] >= 0) {
    Producttoevoegen($conn, $_POST['ProductNaam'], $_POST['Prijs'], $_POST['KortingToevoeg'], $_POST['categorie'], $_POST['Beschrijving'], $_POST['Voorraad'], $_FILES);
}
else
{
    echo"Sterf";
}