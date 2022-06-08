<?php
include 'connection.php';
include 'header.php';
//
$sql=" SELECT * FROM bestelling";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  <link rel="stylesheet" href="style/adminoverzicht.css">
  <title>Adminoverzicht</title>
</head>


  
</style>
<header>
<form method='POST' action=""> 
</form> 
    


<body>
<br><br><br><br>

        <tr>
        <div class='table-wrapper'>
         <table class='fl-table'>
        <thead>
            <th>Naam</th>
            <th>datum</th>
            <th>tijd</th>
            <th>prijs</th>
            <th>info</th>
            </tr>  
        </thead>
        <tbody>
<?php
if(isset($_POST['loguit'])){
  session_destroy();
  header('Location: ');
}
error_reporting(0);
if(isset($_SESSION['admin_name'])){
$query= "SELECT * FROM bestelling";
} elseif (isset($_SESSION['user_name'])){
  $naam=$_SESSION['user_name'];
$query= "SELECT * FROM bestelling WHERE `naam`='$naam'";}
$data = mysqli_query($conn,$query);
$total = mysqli_num_rows($data);
if($total!=0){
  while($result=mysqli_fetch_assoc($data)){
      echo "
      <tr>
      
      <td>".$result['naam']."</td>
      <td>".$result['datum']."</td>
      <td>".$result['tijd']."</td>
      <td>".'€'.$result['totaal']."</td>
      <td><a style='color: black;' class='fas fa-info' href='?id=" . $result['id'] . "#myForm'></a></td>
      <tbody>
      ";
  }
    }else{
      echo "
      <tr>
      <th colspan='2'>Er is geen data gevonden!!!</th>
      </tr>
      ";
  } ?>
 
  </table>

  <div class='form-popup' id='myForm'>

<?php
 $id= $_GET['id'];
$sql= "SELECT * FROM bestelling where id=$id";
$res = $conn->query($sql);
if ($res) {
  foreach ($res as $result) {
echo"
<p class='naam'>".$result['naam']."</p>
<p class='tijd'>afhaaltijdstip: ".$result['tijd']."</p>
<br>
<p class='datum'>".$result['datum']."</p>
<br>
<p>".$result['name']."</p>
<br><br><br>
<p>".'€'.$result['totaal']."</p>


";}} ?>
      

    <a type='button' class='sluitknop' href='/adminoverzicht.php#'>&times;</a>

</div>
  
</body>

</html>
