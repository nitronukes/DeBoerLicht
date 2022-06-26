<?php
include '../Pagina/Connection.php';
include '../Pagina/Functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo $_POST['categorie'];
    Producttoevoegen($conn, $_POST['ProductNaam'], $_POST['Prijs'], $_POST['KortingToevoeg'], $_POST['categorie'], $_POST['Beschrijving'], $_POST['Voorraad'], $_FILES);
};