<!DOCTYPE html>
<html>
    <head>
    <title>winkelwagen</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    <link rel="stylesheet" href="../css/Styles.css">
    <
    </head>
    <body>
    <div class="container">
        <?php
        include 'Connection.php';
        include 'header.php';

        $sql = "SELECT * FROM winkelwagen order by id ASC;";
        $result = mysqli_query($conn, $sql);

        if($result):
            if(mysqli_num_rows($result)>0):
                while($product= mysqli_fetch_assoc($result)):
                print_r($product);
                 ?>
            <div class="col-sm-4 col-md-3">
                <form method="post" action="winkelwagenn.php?action=add&id <?php echo $product['id']; ?>">
                <div class="products">
                    <img src="<?php echo $product['foto'];?> " class="img-repsonsive"/>
                    <h4 class="text-info"><?php echo $product['naam']; ?></h4>
                    <h4>$ <?php echo $product['prijs'];?></h4>
                    <input type="text" name="hoeveelheid" class="form-control" value="1" />
                    <input type="hidden" name="naam" value="<?php echo $product['naam'];?>"/>
                    <input type="hidden" name="prijs" value="<?php echo $product['prijs'];?>"/>
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




