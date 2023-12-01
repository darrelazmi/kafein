<?php
    include('config.php');
    session_start();
	if(!isset($_SESSION['id'])){
        session_destroy();
        header("refresh:3; url=index.php");
        die("Forbidden... Redirecting to home...");
    }
    else{
        $id = $_SESSION['id'];
        $type = $_SESSION['type'];
    }
    if (isset($_GET['c_id'])) {
        $cafe_id = $_GET['c_id'];
        $query = mysqli_query($connect, "SELECT * FROM `cafe` WHERE `cafe_id` = '$cafe_id'");
        $data = mysqli_fetch_array($query);
        if(isset($_POST['tambah'])){
            $text = $_POST['review_text'];
            $q = mysqli_query($connect, "INSERT INTO `reviews`(`cafe_id`, `customer_id`, `review`) VALUES('$cafe_id', '$id', '$text')");
            if($q){
                header("Location: cafe-detail.php?c_id=".$cafe_id."");
            }
        }
        if(isset($_POST['batal'])){
            header("Location: cafe-detail.php?c_id=".$cafe_id."");
        }
    }
?>