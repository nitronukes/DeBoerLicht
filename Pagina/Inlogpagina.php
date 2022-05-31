<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Styles.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js%22%3E"></script>
    <title>Document</title>
</head>
<body>
    <div class="InlogPaginaGrid">
        <div class="InlogPaginaBlokLinks"></div>
        <div class="InlogPaginaBlokRechts"></div>
        <div class="InlogPaginaBlokTop"></div>
        <div class="InlogPaginaBlokBottom"></div>
        <div class="InlogGrid">
            <div class="InlogBlokLinks"></div>
            <div class="InlogBlokRechts"></div> 
            <div><h2>Inloggen</h2></div>
            <form method="POST" action="#">
            <div class="InlogInputDiv"><input class="InlogInput" type="tekst" placeholder="E-mail" name="Email" required></div>
            <div class="InlogInputDiv"><input class="InlogInput" type="password" placeholder="Wachtwoord" name="Wachtwoord" required></div>
            <div></div>
            <div><center><button name="Login" onclick="window.location.href='Bestellingenoverzicht.php'" type="submit" class="InlogButton">Log in</button></center></div>
            
        </div></form>

    </div>


</body>
</html>

<?php
session_start();
include("Connection.php");
include("Functions.php");

//$username = check_login($conn);

if(isset($_POST['Email']))
    {
        $mail = $_POST['Email'];
        $wachtwoord = $_POST['Wachtwoord'];

        $sql = "select * from users where email = '".$mail."'AND password = '".$wachtwoord."' limit 1";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1)
        {
          echo "You logged in";
        }
        else {
          echo "You have entered incorrect email or username";
        }
    }
