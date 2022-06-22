<?php
session_start();
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

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>