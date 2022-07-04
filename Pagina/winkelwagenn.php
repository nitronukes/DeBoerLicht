<?php

include 'header.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
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
            <form method='POST' action='removeproduct.php'>
                <div class='btn-danger'>
                    <input class='winkelwagenknop' type='submit'>
                </div> <br>
                
                <input hidden type='text' name='productid' value='$productid'/>$productid
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



<?php
//session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Bestelformulier</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Bestelformulier
                            <a href="winkelwagenn.php" class="btn btn-danger float-end">Terug</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">

                            <div class="mb-3">
                                <label>Volledige naam</label>
                                <input type="text" name="name" class="form-control" required placeholder="voer je naam in">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required placeholder="Vul je email in">
                            </div>
                            <div class="mb-3">
                                <label>Telefoonnummer</label>
                                <input type="text" name="phone" class="form-control" required placeholder="Vul je telefoonnummer in">
                            </div>
                            <div class="mb-3">
                                <label>Adress</label>
                                <input type="text" name="adress" class="form-control" required placeholder="Vul je adress in">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="save_student" class="btn btn-primary">Voeg bestelling toe</button>
                            </div>
                            <?php
                            if (isset($_SESSION['cart'])!='')
                            {$_SESSION['bestelling'][] = array('');}


                            ?>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>