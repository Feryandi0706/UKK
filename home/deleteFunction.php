<?php
require "../koneksi.php";
$id = $_GET['id'];
echo $id;
// Delete postingan
$sql = "delete from tweets where id_tweets='$id'";
$query = mysqli_query($con,$sql);
// Delete comment yang sesuai id postingan
$sqlDelKom = "delete from comments where id_tweets='$id'";
$queryDelKom = mysqli_query($con, $sqlDelKom);
// Delete tag yang sesuai postingan
$sqlDelTag = "delete from tags where id_tweets='$id'";
$queryDelTag = mysqli_query($con, $sqlDelTag);

header("location:home.php");