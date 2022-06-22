<?php
//include 'Connection.php';
include 'header.php';
session_start();
$product_ids = array();
session_destroy();
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
    pre_r($_SESSION);
}


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
        <!--?php echo $product['foto'];?> --->

    </head>
    <body>
    <div class="container">
        <?php

        $connect = mysqli_connect('localhost', 'root', '', 'deboerlicht');
        $sql = "SELECT * FROM winkelwagen order by id ASC;";
        $result = mysqli_query($connect, $sql);


        if($result):
            if(mysqli_num_rows($result)>0):
                while($product= mysqli_fetch_assoc($result)):
                    //als je de data base wil na kijken gebruik de command hier onder
                //print_r($product);
                 ?>

                <!--kleine productpagina om te testen of we winkelwagen werkt--->
            <div class="col-sm-4 col-md-3">
                <form method="post" action="winkelwagenn.php?action=add&id=<?php echo $product['id']; ?>">
                <div class="products">
                    <img src=src="../Fotos/Lamp5.png" class="img-responsive"/>
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
          %total =0;

        foreach ($_SESSION['winkelwagen'] as $key => $product):

        ?>



        <?php
         endif;
        ?>
    </table>
</div>



