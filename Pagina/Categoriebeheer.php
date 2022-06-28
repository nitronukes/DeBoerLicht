<?php
session_start();
require 'Connection.php';
include 'header.php';
if (isset($_GET['deleteID'])) {
    $DeleteID = $_GET['deleteID'];
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/Styles.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Bestellingenoverzicht</title>
</head>

<body>

    <div class="container mt-4">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Categorie</th>
                                <th>Actie</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($DeleteID)) {

                                if ($DeleteID > -1) {
                                    CategorieVerwijderen($conn, $DeleteID);
                                }
                            }

                            if ($_SERVER["REQUEST_METHOD"] === "POST" & isset($_POST['Categorie'])) {
                                CategorieUpdate($conn, $_POST['Categorie'], $_POST['CategorieID']);
                            }
                            if ($_SERVER["REQUEST_METHOD"] === "POST" & isset($_POST['Categorienaam'])) {
                                Categorietoevoegklik($conn, $_POST['Categorienaam']);
                            }
                            CategorieToevoegen($conn);
                            CategorieTonen($conn);

                            ?>


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>