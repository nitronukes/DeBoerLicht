<?php
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