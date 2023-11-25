<?php
    include("config.php");
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
    if (isset($_SESSION["id"])) {
        $id = $_SESSION["id"];
        $type = $_SESSION["type"];
        $cafe_id;
        if(isset($_GET['id'])){
            $cafe_id = $_GET['id'];
            $query = mysqli_query($connect,"DELETE FROM `cafe` WHERE `cafe_id` = '$cafe_id'");
            echo "Kafe berhasil dihapus... Kembali dalam 3 detik...";
            header("refresh:3; url=mycafe.php");
        }else{
            header("Location: error.php");
        }
    }
?>