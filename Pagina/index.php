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
<?php 
// Connectding 
require_once 'Connection.php'; 
 
// Foto uit database selecteren 
$result = $db->query("SELECT foto FROM productfoto ORDER BY ID DESC"); 
?>

<?php if($result->num_rows > 0){ ?> 
    <div class="gallery"> 
        <?php while($row = $result->fetch_assoc()){ ?> 
            <img src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['foto']); ?>" /> 
        <?php } ?> 
    </div> 
<?php } else { ?> 
    <p class="status error">er is geen foto aap</p> 
<?php } ?>