<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Styles.css">
    <title>Homepagina</title>
</head>
<body>
    <div class="homebodylichaam">
        <div class="homepaginaLinks"></div>
        <div class="homepaginaRechts"></div>
        <div class="gekketest">bhnmjhnmcgn</div>
        <div><?php 
// Connectding 
require_once 'Connection.php'; 

$sql="SELECT * FROM productfoto";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result)){
echo "
";
echo "<img src='images/'".$row['Foto']."'>";
"

";
echo "
";

}
?></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    
</body>
</html>
