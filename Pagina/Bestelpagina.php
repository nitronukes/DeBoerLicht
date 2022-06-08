<?php



?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bestelling form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/Styles.css">

</head>
<body>
   
<div class="form-containerr">

   <form action="" method="post">
      <h3>Voer je gegevens in</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="Voornaam">
      <input type="Achternaam" name="achternaam" required placeholder="Achternaam">
      <input type="email" name="email" required placeholder="Email">
      <input type="telefoonnummer" name="telefoonnummer" required placeholder="Telefoonnummer">
      <input type="huisnummer" name="huisnummer" required placeholder="Huisnummer">
      <input type="straatnaam" name="straatnaam" required placeholder="Straatnaam">
      <input type="postcode" name="postcode" required placeholder="Postcode">
      
      <input type="submit" name="registreer" value="stuur" class="form-btn">
   </form>

</div>

</body>
</html>