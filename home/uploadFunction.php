<?php
require '../koneksi.php';
$action = $_GET['action'];
if ($action == "save") {
    $text_hastag = $_GET['text_hastag'];
    $file = $_GET['file'];
    $email = $_GET['email'];
    $date = date("Y-m-d");

    // $list = array();
    $dataSplit = explode("#", $text_hastag);
    $indexTag = count($dataSplit);


    // echo $idTweetsBaru;

    $sql = "insert into tweets(text_hastag, email,file,tgl) values('$dataSplit[0]','$email','$file','$date')";
    $query = mysqli_query($con, $sql);

    $sqlCheckID = "select * from tweets";
    $queryCheckID = mysqli_query($con, $sqlCheckID);
    $arrayID = array();
    while ($resultCheckID = mysqli_fetch_array($queryCheckID)) {
        array_push($arrayID, $resultCheckID['id_tweets']);
    }
    $getLASTID = end($arrayID);
    $idTweetsBaru = $getLASTID;


    for ($i = 1; $i < $indexTag; $i++) {
        $sqlTag = "select * from tags where tags='$dataSplit[$i]'";
        $queryTag = mysqli_query($con, $sqlTag);
        $nums_rows_tag = mysqli_num_rows($queryTag);
        if ($nums_rows_tag == 0) {
            $sqlInsertTag = "insert into tags(tags,id_tweets) values('$dataSplit[$i]','$idTweetsBaru')";
            $queryInsertTag = mysqli_query($con, $sqlInsertTag);
        }
        else {
            // $sqlInsertTag = "insert tags set tags='$dataSplit[$i]' where id_tweets='$idTweetsBaru'";
            // $queryInsertTag = mysqli_query($con, $sqlInsertTag);
            $sqlInsertTag = "insert into tags(tags,id_tweets) values('$dataSplit[$i]','$idTweetsBaru')";
            $queryInsertTag = mysqli_query($con, $sqlInsertTag);
        }
    }

    header("location:home.php");


} 
else if ($action == "edit") {
    $id_tweets = $_GET['id_tweets'];
    $text_hastag = $_GET['text_hastag'];
    $file = $_GET['file'];
    $email = $_GET['email'];
    $date = date("Y-m-d");

    // echo $text_hastag;
    if ($file == "") {
        $sql = "update tweets set text_hastag='$text_hastag', email='$email', tgl='$date' where id_tweets='$id_tweets'";
        $query = mysqli_query($con, $sql) or die($sql);

        header("location:home.php");
    } else {
        $sql = "update tweets set text_hastag='$text_hastag', file='$file', email='$email', tgl='$date' where id_tweets='$id_tweets'";
        $query = mysqli_query($con, $sql) or die($sql);

        header("location:home.php");
    }
}
