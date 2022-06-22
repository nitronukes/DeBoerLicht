<?php
session_start();
require 'Connection.php';

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($conn, $_POST['delete_student']);

    $query = "DELETE FROM bestellingen WHERE id='$student_id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student verwijderd";
        header("Location: Bestellingenoverzicht.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Klant verwijderd";
        header("Location: Bestellingenoverzicht.php");
        exit(0);
    }
}

if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $adress = mysqli_real_escape_string($con, $_POST['adress']);

    $query = "UPDATE bestellingen SET name='$name', email='$email', phone='$phone', adress='$adress' WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Klant succesvol geupdate";
        header("Location: Bestellingenoverzicht.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Klant niet geupdate";
        header("Location: Bestellingenoverzicht.php");
        exit(0);
    }

}


if(isset($_POST['save_student']))
{
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $adress = mysqli_real_escape_string($conn, $_POST['adress']);

    $query = "INSERT INTO bestellingen (name,email,phone,adress) VALUES ('$name','$email','$phone','$adress')";

    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: Bestelpagina.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Created";
        header("Location: Bestelpagina.php");
        exit(0);
    }
}

?>