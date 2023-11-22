<?php 
    include("config.php");
    session_start();
    if(isset($_SESSION["id"])){
        $id = $_SESSION["id"];
        $type = $_SESSION["type"];
        if ($type=='owner') {
            $query = mysqli_query($connect,"SELECT * FROM `cafe` WHERE `owner_id`='$id'");
            $data = mysqli_fetch_array($query);
        }else{
            # code...
        }
    }
?>

