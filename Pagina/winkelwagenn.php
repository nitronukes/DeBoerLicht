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
//    if(filter_input(INPUT_GET, 'action')== 'delete'){
//        //loop door al de producten heen todat het gelijk is aan get id variabelen
//        foreach ($_SESSION['winkelwagen'] as $key => $product){
//            if($product['ID']== filter_input(INPUT_GET, 'ID')){
//               //verwijder product uit winkelwagen
//                unset($_SESSION['winkelwagen'][$key]);
//            }
//        }
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
}
?>
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
<!--        --><?php
//
//
//        $query = "SELECT * FROM producten order by ID ASC;";
//        $result = mysqli_query($connect, $query);
//
//
//        if($result):
//            if(mysqli_num_rows($result)>0):
//                while($product= mysqli_fetch_assoc($result)):
//                    //als je de data base wil na kijken gebruik de command hier onder
//
//                 ?>
<!---->
<!---->
<!--                --><?php
//                endwhile;
//            endif;
//           endif;
//
//
//?>

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
        if(!empty($_SESSION['cart'])):


        $total =0;

        foreach ($_SESSION['cart'] as $product):
           // var_dump($product);
            // query op basis van id
            // id is $product['id']
            $connect = mysqli_connect('localhost', 'root', '', 'deboerlicht');
            $sql = "select * from producten where ID = " . $product['id'];
            $result = mysqli_query($connect, $sql);
            $row =mysqli_fetch_assoc($result);




        ?>
        <tr>
            <td><?php echo $row['ProductNaam'];?></td>
            <td><?php echo $product['aantal'];?></td>
            <td><?php echo"€", "", $row['Prijs'];?></td>
            <td><?php echo number_format($product['aantal'] * $row['Prijs'], 2);?></td>
            <td>
                <a href="winkelwagenn.+&id=<?=$product['id']?> ">
                    <div class="btn-danger">Verwijderen</div>
                </a>
            </td>
        </tr>
        <?php
            $total = $total + ($product['aantal'] * $row['Prijs']);
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
                <a href="#" class="button">Checkout</a>
                <?php endif; endif; ?>
            </td>
        </tr>
        <?php
         endif;
        ?>
    </table>
</div>



