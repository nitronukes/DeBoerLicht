<?php

include 'header.php';

$product_ids = array();
//session_destroy();
//kijken of product naar winkelwagen is verstuurd
if(filter_input(INPUT_POST, 'add_to_cart')){
    if(isset($_SESSION['winkelwagen'])){

        //bijhouden hoeveel producten in de winkelwagen zitten
            $count = count($_SESSION['winkelwagen']);

        //maak een sequantial array om array keys aan products ids vast te maken
            $product_ids = array_column($_SESSION['winkelwagen'], 'id');

        if(!in_array(filter_input(INPUT_GET,'id' ), $product_ids)){
            $_SESSION['winkelwagen'][$count] = array
            (
                'id' => filter_input(INPUT_GET, 'id'),
                'naam' => filter_input(INPUT_POST,'naam'),
                'prijs' => filter_input(INPUT_POST, 'prijs'),
                'hoeveelheid' => filter_input(INPUT_POST, 'hoeveelheid'),

        );

        }
        else{
            //array key gelijk maken aan id van het product dat word toegevoegd aan de winkelwagen
            for($i = 0; $i < count($product_ids); $i++){
                if($product_ids[$i] == filter_input(INPUT_GET, 'id')){
                    //toevoegen hoeveelheid aan bestaand item in de array
                    $_SESSION['winkelwagen'][$i]['hoeveelheid'] += filter_input(INPUT_POST, '');
                }
            }
        }
    }
    else{// als winkelwagen session niet bestaal maak een product array met key 0
        //array maken met toegevoegde data, start bij key 0 en vul het net variabelen
        $_SESSION['winkelwagen'][0] = array
        (
              'id'=> filter_input(INPUT_GET, 'id'),
              'naam'=> filter_input(INPUT_POST,'naam'),
              'prijs'=> filter_input(INPUT_POST, 'prijs'),
              'hoeveelheid'=> filter_input(INPUT_POST, 'hoeveelheid')
        );
    }
    }
    if(filter_input(INPUT_GET, 'action')== 'delete'){
        //loop door al de producten heen todat het gelijk is aan get id variabelen
        foreach ($_SESSION['winkelwagen'] as $key => $product){
            if($product['id']== filter_input(INPUT_GET, 'id')){
               //verwijder product uit winkelwagen
                unset($_SESSION['winkelwagen'][$key]);
            }
        }
        //reset session array keys zodat ze gelijk zijn aan $product_ids numeric array
        $_SESSION['winkelwagen'] = array_values($_SESSION['winkelwagen']);


}
pre_r($_SESSION);

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
        <?php

        $connect = mysqli_connect('localhost', 'root', '', 'deboerlicht');
        $query = "SELECT * FROM winkelwagen order by id ASC;";
        $result = mysqli_query($connect, $query);


        if($result):
            if(mysqli_num_rows($result)>0):
                while($product= mysqli_fetch_assoc($result)):
                    //als je de data base wil na kijken gebruik de command hier onder

                 ?>

                <!--kleine productpagina om te testen of we winkelwagen werkt--->
            <div class="col-sm-4 col-md-3">
                <form method="post" action="winkelwagenn.php?action=add&id=<?php echo $product['id']; ?>">
                <div class="products">
                    <img src="../Fotos/Lamp5.png" class="img-responsive" alt="kaas"/>
                    <h4 class="text-info"><?php echo $product['naam']; ?></h4>
                    <h4>$ <?php echo $product['prijs'];?></h4>
                    <input type="text" name="hoeveelheid" class="form-control" value="1"/>
                    <input type="hidden" name="naam" value="<?php echo $product['naam']; ?>"/>
                    <input type="hidden" name="prijs" value="<?php echo $product['prijs']; ?>"/>
                    <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-info"
                        value="voeg toe aan winkelwagen" />

                </div>
                </form>
            </div>

                <?php
                endwhile;
            endif;
           endif;


?>

    </div>
    </body>
</html>

<div class="clear:both"></div>
<br />
<div class="table-responsive">
    <table class="table">
        <tr><th colspan="$"><h3>Order details</h3></th> </tr>
        <tr>
            <th width="40%">Product naam</th>
            <th width="10%">Hoeveelheid</th>
            <th width="20%">Prijs</th>
            <th width="15%">Totaal</th>
            <th width="5%">Actie </th>
        </tr>
        <?php
        if(!empty($_SESSION['winkelwagen'])):


        $total =0;

        foreach ($_SESSION['winkelwagen'] as $key => $product):

        ?>
        <tr>
            <td><?php echo $product['naam'];?></td>
            <td><?php echo $product['hoeveelheid'];?></td>
            <td><?php echo $product['prijs'];?></td>
            <td><?php echo number_format($product['hoeveelheid'] * $product['prijs'], 2);?></td>
            <td>
                <a href="winkelwagenn.php?action=delete&id=<?php echo $product['id'];?>">
                    <div class="btn-danger">Verwijderen</div>
                </a>
            </td>
        </tr>
        <?php
            $total = $total + ($product['hoeveelheid'] * $product['prijs']);
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
                if (isset($_SESSION['winkelwagen'])):
                if (count($_SESSION['winkelwagen']) > 0):
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



