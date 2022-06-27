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
 <center>
 <div class="InlogPaginaGrid">
   <div class="InlogPaginaBlokLinks"></div>
   <div class="InlogPaginaBlokRechts"></div>
   <div class="InlogPaginaBlokTop"></div>
   <div class="InlogPaginaBlokBottom"></div>
   <form method="post" action="">
   <div class="InlogGrid">
     <div class="InlogBlokLinks"></div>
     <div class="InlogBlokRechts"></div> 
        <h1 class="inlogtekst">Inloggen</h1>
          <div class="y"><input class="InlogInputDiv" type="text" name="Email" class="text" autocomplete="off" required placeholder="E-mail">
          <input class="InlogInputDiv" type="password" name="Wachtwoord" class="text" required placeholder="Wachtwoord"></div>
          <div class="x"><input class="InlogButton" type="submit" name="submit" id="sub"> </div>
          
    </div>
      </form>
        

   </div>
    </center>
    </div>
</body>
</html>

<?php

include 'Connection.php';
include 'Functions.php';
if (isset($_POST['submit'])) {
    $email=$_POST['Email'];
    $wachtwoord=$_POST['Wachtwoord'];
  Inloggen($conn, $email, $wachtwoord);
}
?>


 
