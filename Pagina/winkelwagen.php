
<?php
include 'Connection.php';
include 'header.php';

$sql=" SELECT * FROM winkelwagen";
$result = $conn->query($sql);

?>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>
<?php
$sql = "SELECT * FROM winkelwagen;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo
        $row['naam'];
        $row['prijs'];
    }
}







?>
<div class="right-bar"></div>
            <p><span>Subtotaal</span> <span>120euro</span> </p>
    <hr>
            <p><span>Tax (5%)</span>  <span>6euro</span></p>
    <hr>
            <p><span>shipping</span>  <span>15euro</span></p>
    <hr>
            <p><span>Totaal</span>  <span>141euro</span></p>
</div>
</div>
</body>
</html>

