<?php
include "Connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$voornaam = $_POST['voornaam'];
	$achternaam = $_POST['achternaam'];
	$email = $_POST['email'];
	$telefoonnummer = $_POST['telefoonnummer'];
	$straatnaam = $_POST['straatnaam'];
	$huisnummer = $_POST['huisnummer'];
   $postcode = $_POST['postcode'];
}

	// Database connectie
	// $conn = new mysqli('localhost','root','','deboerlicht');
	// if($conn->connect_error){
	// 	echo "$conn->connect_error";
	// 	die("Connection Failed : ". $conn->connect_error);
	// } else {
		$stmt = $conn->prepare("INSERT INTO `bestellingen` (`voornaam`, `achternaam`, `email`, `telefoonnummer`, `straatnaam`, `huisnummer`, `postcode`) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssss", $voornaam, $achternaam, $email, $telefoonnummer, $straatnaam, $huisnummer, $postcode);
		$stmt->execute();
		$stmt->close();
		$conn->close();
	//}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Vul gegevens in</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
  </head>
  <body>
    <div class="container">
      <div class="row col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading text-center">
            <h1>Bestelformulier</h1>
          </div>
          <div class="panel-body">
            <form action="connect.php" method="post">
              <div class="form-group">
                <label for="voornaam">voornaam</label>
                <input
                  type="text"
                  class="form-control"
                  id="voornaam"
                  name="voornaam"
                />
              </div>
              <div class="form-group">
                <label for="achternaam">achternaam</label>
                <input
                  type="text"
                  class="form-control"
                  id="achternaam"
                  name="achternaam"
                />
              </div>
              <div class="form-group">
                <label for="email">email</label>
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  name="email"
                />
              </div>
              <div class="form-group">
                <label for="Telefoonnummer">Telefoonnummer</label>
                <input
                  type="text"
                  class="form-control"
                  id="Telefoonnummer"
                  name="Telefoonnummer"
                />
              </div>
                 
                
              
              <div class="form-group">
                <label for="Straatnaam">Straatnaam</label>
                <input
                  type="text"
                  class="form-control"
                  id="Straatnaam"
                  name="Straatnaam"
                />
              </div>
              <div class="form-group">
                <label for="huisnummer">huisnummer</label>
                <input
                  class="form-control"
                  id="huisnummer"
                  name="huisnummer"
                />
              </div>
              <div class="form-group">
                <label for="postcode">postcode</label>
                <input
                  class="form-control"
                  id="postcode"
                  name="postcode"
                />
              </div>
              <input type="submit" class="btn btn-primary" />
            </form>
          </div>
          <div class="panel-footer text-right">
            <small>&copy; Made by Christian</small>
          </div>
        </div>
      </div>
    </div>
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  
</div>
  </body>
</html>