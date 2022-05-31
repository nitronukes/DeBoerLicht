<?php

function check_login($conn)
{
    if(isset($_POST['email']))
    {
        $mail = $_POST['email'];
        $wachtwoord = $_POST['wachtwoord'];
    }
}