<?php
require '../koneksi.php';
$id_comments = $_GET['id_comments'];
$sql = "delete from comments where id_comments='$id_comments'";
$query = mysqli_query($con, $sql);

header("location:home.php");