<?php

include 'header.php';

function pre_r($array){
    echo'<pre>';
    print_r($array);
    echo'</pre>';
}

if (isset($_POST['action'])) {
    echo "A";
    if ($_POST['action'] == 'remove') {
        echo "B";
        $removalpid = $_POST['productid'];

        foreach ($_SESSION['cart'] as $productid => $productinfo) {
            echo "C";
            if ($productid == $removalpid) {
                echo "D";
                if ($productinfo['amount'] > 1) {
                    echo "E";
                    $_SESSION['cart'][$productid]['amount']--;
                } else {
                    echo "F";
                    unset($_SESSION['cart'][$productid]);
                }
            }
        }

        //header("Location: winkelwagenn.php");

    }
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

        pre_r($_SESSION['cart']);

        foreach ($_SESSION['cart'] as $productid => $productinfo) {
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
            
            <form action='removeproduct.php' method='post'>
                <div class='btn-danger'>
                    <btn type='submit'>Verwijderen</btn>
                </div>
                <input hidden type='text' name='productid' value='$productid'/>$productid
                <input hidden type='text' name='action' value='remove'/>remove
            </form>
            
            </a>
            </td>
            </tr>
            ";


            $total = $total + ($aantal * $prijs);
            }
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
        ?>
    </table>
</div>



