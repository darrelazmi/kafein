<?php
    include("config.php");
    session_start();
    if (isset($_SESSION["id"])) {
        $id = $_SESSION["id"];
        $type = $_SESSION["type"];
        if($type=='owner'){
            if ($query = mysqli_query($connect,"DELETE FROM `owner` WHERE `owner_id` = '$id'")) {
                session_destroy();
                header("Location: index.php");
            }else {
                header("Location: error.php");
            }
        }else if($type=='customer'){
            if ($query = mysqli_query($connect,"DELETE FROM `owner` WHERE `owner_id` = '$id'")) {
                session_destroy();
                header("Location: index.php");
            }else {
                header("Location: error.php");
            }
        }else{
            header("Location: error.php");
        }
    }
?>