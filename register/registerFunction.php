<?php
    // session_start();
    require "../koneksi.php";
    $username = $_GET['username'];
    $email = $_GET['email'];
    $password = md5($_GET['password']);


    $sql = "insert into users(username,email,password) values('$username','$email','$password')";
    $query = mysqli_query($con, $sql) or die($sql);
    header("location:../index.php");
?>