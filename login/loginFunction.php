<?php 
    session_start();
    require "../koneksi.php";

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "select * from users where email='$email' and password='$password'";
    $query = mysqli_query($con, $sql);
    $num_row = mysqli_num_rows($query);

    $resultData = mysqli_fetch_array($query);
    $username = $resultData['username'];
    $bio = $resultData['bio'];
    $foto = $resultData['foto'];

    if($num_row == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['bio'] = $bio;
        $_SESSION['foto'] = $foto;
        header('location:../home/home.php');
    }
    else {
        echo "
            <script>
                alert('maaf anda tidak memiliki akses');
                location.href = 'loginPage.php';
            </script>
        ";
    }
?>