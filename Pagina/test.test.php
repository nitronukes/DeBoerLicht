<?php
function Lampenoverzicht($conn, $categorie)
{
$stmt = $conn->prepare("SELECT * FROM producten INNER JOIN productfoto ON producten.ID = productfoto.ProductID");

}





?>