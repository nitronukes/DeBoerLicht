<?php

include 'Connection.php';

if(isset($_POST['registreer'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = 'user';

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user bestaat al!';

   }else{

      if($pass != $cpass){
         $error[] = 'De wachtwoorden komen niet overeen!';
      }else{
 
         $sql = "INSERT INTO bestellingen(name, email, password, user_type, bevestig) VALUES('$name', '$email', '$pass','$user_type', 'false')";
         $insert = $conn->query($sql);

         if ($insert)

         
         //mail versturen met de mail van de gebruiker en die het invuld
         $receiver = array($email);
         $subject="Bevestig registratie";
         $body = "Beste $name,
         
         Om uw account aan te maken moet u eerst bevestigen.
         Bevestig: https://p31t2.lesonline.nu/bevestig.php?id=$conn->insert_id 
        
         
         Met vriendelijke groet,
         click collect snack";
         //hier kijk die of de mail  verstuurt kan worden zo ja  zegt die de eerste optie zo niet zegt die de tweede optie 
          
            
          }
          if(mail(implode(',',$receiver), $subject, $body)){

            echo "<script>alert('Kijk uw mail voor bevestiging')</script>";
                     
         }}}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/Product.css">

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
      <input type="email" name="achternaam" required placeholder="Achternaam">
      <input type="password" name="email" required placeholder="Email">
      <input type="password" name="telefoonnummer" required placeholder="Telefoonnummer">
      <input type="password" name="huisnummer" required placeholder="Huisnummer">
      <input type="password" name="straatnaam" required placeholder="Straatnaam">
      <input type="password" name="postcode" required placeholder="Postcode">
      
      <input type="submit" name="registreer" value="registreer nu" class="form-btn">
   </form>

</div>

</body>
</html>