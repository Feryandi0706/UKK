<?php
require "../koneksi.php";
$action = $_GET['action'];

if($action == "save") {
    $comments = $_GET['comments'];
    $id_tweets = $_GET['id_tweets_comments'];

    $commentsSplit = explode("#", $comments);

    for ($i = 1; $i < $indexTag; $i++) {
        $sqlTag = "select * from comment where tags='$dataSplit[$i]'";
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


    $sql = "insert into comments(id_tweets,comments) values('$id_tweets','$comments')";
    $query = mysqli_query($con,$sql);

    header("location:home.php");
}
else if($action == "edit"){
    $comments = $_GET['comments'];
    $id_comments = $_GET['id_comments'];

    $sql = "update comments set comments='$comments' where id_comments='$id_comments'";
    $query = mysqli_query($con,$sql);

    header("location:home.php");
}