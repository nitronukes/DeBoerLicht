<?php
session_start();
    if (!isset($_SESSION)) {

    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $productid = $_POST['productid'];
    $amounttoadd = $_POST['amounttoadd'];

    if (isset($_SESSION['cart'][$productid])) {
        $_SESSION['cart'][$productid] = array(
            "amount" => $_SESSION["cart"][$productid]["amount"] + $amounttoadd,
            );
    } else {
        $_SESSION['cart'][$productid] = array(
            "amount" => 1,
            );
    }

    header("Location: winkelwagenn.php");
?>