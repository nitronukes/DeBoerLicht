<?php

include 'header.php';

//session_destroy();
$product_ids = array();
////kijken of product naar winkelwagen is verstuurd
//if(filter_input(INPUT_POST, 'add_to_cart')){
//    if(isset($_SESSION['winkelwagen'])){
//
//        //bijhouden hoeveel producten in de winkelwagen zitten
//            $count = count($_SESSION['winkelwagen']);
//
//        //maak een sequantial array om array keys aan products ids vast te maken
//            $product_ids = array_column($_SESSION['winkelwagen'], 'ID');
//
//        if(!in_array(filter_input(INPUT_GET,'ID' ), $product_ids)){
//            $_SESSION['winkelwagen'][$count] = array
//            (
//                'ID' => filter_input(INPUT_GET, 'ID'),
//                'ProductNaam' => filter_input(INPUT_POST,'ProductNaam'),
//                'Prijs' => filter_input(INPUT_POST, 'Prijs'),
//                'hoeveelheid' => filter_input(INPUT_POST, 'hoeveelheid'),
//
//        );
//
//        }
//        else{
//            //array key gelijk maken aan id van het product dat word toegevoegd aan de winkelwagen
//            for($i = 0; $i < count($product_ids); $i++){
//                if($product_ids[$i] == filter_input(INPUT_GET, 'ID')){
//                    //toevoegen hoeveelheid aan bestaand item in de array
//                    $_SESSION['winkelwagen'][$i]['hoeveelheid'] += filter_input(INPUT_POST, '');
//                }
//            }
//        }
//    }
//    else{// als winkelwagen session niet bestaal maak een product array met key 0
//        //array maken met toegevoegde data, start bij key 0 en vul het net variabelen
//        $_SESSION['winkelwagen'][0] = array
//        (
//              'ID'=> filter_input(INPUT_GET, 'ID'),
//              'ProductNaa'=> filter_input(INPUT_POST,'PrductNaam'),
//              'Prijs'=> filter_input(INPUT_POST, 'Prijs'),
//              'hoeveelheid'=> filter_input(INPUT_POST, 'hoeveelheid')
//        );
//    }
//    }

    if(filter_input(INPUT_GET, 'action')== 'delete') {
        //loop door al de producten heen todat het gelijk is aan get id variabelen
        foreach ($_SESSION['cart'] as $key => $product) {
            if ($product['id'] == filter_input(INPUT_GET, 'id')) {
                //verwijder product uit winkelwagen
                unset($_SESSION['cart'][$key]);
            }
        }
    }

//        //reset session array keys zodat ze gelijk zijn aan $product_ids numeric array
//        $_SESSION['winkelwagen'] = array_values($_SESSION['winkelwagen']);
//
//
//}
//pre_r($_SESSION);

function pre_r($array){
    echo'<pre>';
    print_r($array);
    echo'</pre>';
}?>

<!DOCTYPE html>
<html>
    <head>
    <title>winkelwagen</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    <link rel="stylesheet" href="../css/Styles.css">

    </head>
    <body>

    <div class="container">


    </div>
    </body>
</html>

<div class="clear:both"></div>
<br />
<div class="table-responsive">
    <table class="table">
        <tr><th colspan="$"><h3>Orderdetails</h3></th> </tr>
        <tr>
            <th width="40%">Product naam</th>
            <th width="10%">Hoeveelheid</th>
            <th width="20%">Prijs</th>
            <th width="15%">Totaal</th>
            <th width="5%">Actie </th>
        </tr>
        <?php

        $total = 0;

        foreach ($_SESSION['cart'] as $productid => $productinfo):
            $connect = mysqli_connect('localhost', 'root', '', 'deboerlicht');
            $sql = "SELECT * FROM producten WHERE ID = " . $productid;
            $result = mysqli_query($connect, $sql);
            $row =mysqli_fetch_assoc($result);

            $productnaam = $row['ProductNaam'];
            $prijs = $row['Prijs'];
            $aantal = $productinfo['amount'];
            $totaal = $prijs * $aantal;


            echo "
            <tr>
            <td>$productnaam</td>
            <td>$aantal</td>
            <td>$prijs</td>
            <td>$totaal</td>
            <td>
            <a href='winkelwagenn.php?action=delete&id=<?=$productid?> '>
            <div class='btn-danger'>Verwijderen</div>
            </a>
            </td>
            </tr>
            ";


            $total = $total + ($aantal * $prijs);
            endforeach;
        ?>
        <tr>
            <td colspan="3" align="right">Totaal</td>
            <td align="right">$ <?php echo number_format($total, 2); ?></td>
            <td></td>
        </tr>
        <tr>

            <td colspan="5">
                <?php
                if (isset($_SESSION['cart'])):
                if (count($_SESSION['cart']) > 0):
                ?>
                <a href="Bestelpagina.php" class="button">Checkout</a>
                <?php endif; endif; ?>
            </td>
        </tr>


        <?php
        //if (isset($_SESSION['cart'])!='') {
        //    $_SESSION['bestelling'][] = array('id' => $product['id'], 'aantal' => $product['aantal'], 'Prijs' => $row['Prijs']);
        //}
        //pre_r($_SESSION);


        //$sql = "insert into winkelmandopstelling(ProductID) values ($product[id])";
        // 1. Loop door alle productIds heen die in de huidige session zitten.


           // $id= $sessionid;

            // 2. maak een sql die geldig is de huidige bestellingId, productId en aantal.
            //$sql = "insert into winkelmandopstelling(BestelId, ProductID, Aantal) values ($bestelId, $product[id], $aantal)";

            // 3. voer de bovenstaande sql uit op de database.





        ?>
    </table>
</div>



