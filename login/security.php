<?php 
    session_start();
    $email = $_SESSION['email'];
    if($email == ""){
        header("location:../index.php");
    }
?>