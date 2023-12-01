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
        $q = mysqli_query($connect, "DELETE FROM `reviews` WHERE `cafe_id` = '$cafe_id' AND `customer_id` = '$id'");
        if($q){
            header("Location: cafe-detail.php?c_id=".$cafe_id."");
        }
    }
?>