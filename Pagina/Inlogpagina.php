<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Styles.css">
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
            <div><center><h2>Inloggen</h2></center></div>
            <div><input class="InlogInput" type="tekst" placeholder="E-mail" name="Email" required></div>
            <div><input class="InlogInput" type="password" placeholder="Wachtwoord" name="Wachtwoord" required></div>
            <div><button name="AccountAanmaken" onclick="window.location.href='Index.php'" type="submit" class="AccountAanmakenButton">Account aanmaken</button></div>
            <div><button name="Login" onclick="window.location.href='Index.php'" type="submit" class="LoginButton">Log in</button></div>
        </div>

    </div>
</body>
</html>