<?php
    require '../koneksi.php';
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $foto = $_POST['foto'];
    $fotoAvatar = $_POST['foto_avatar'];
    if($foto == "") {
        $foto = $fotoAvatar;
        $sql = "update users set bio='$bio', foto='$foto' where email='$email'";
        $query = mysqli_query($con, $sql);
        header("location:../home/home.php");
    }
    else {
        $sql = "update users set bio='$bio', foto='$foto' where email='$email'";
        $query = mysqli_query($con, $sql);
        header("location:../home/home.php");
    }
    
?>