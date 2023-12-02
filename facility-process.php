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
        $cafeid = $_SESSION['cafe_id'];
    }
    if(isset($_POST['hapus'])){
        $fac = $_POST['fac'];
        if($query = mysqli_query($connect, "DELETE FROM `facilities` WHERE `cafe_id` = '$cafeid' AND `facility_type` = '$fac'")){
            header("Location: cafe-edit.php?c_id=".$cafeid."");
        }
        else{
            echo "Gagal";
        }
    }
    if(isset($_POST['add'])){
        $fac = $_POST['fac_baru'];
        $cek = mysqli_query($connect, "SELECT * FROM `facilities` WHERE `cafe_id` = '$cafeid' AND `facility_type` = '$fac'");
        if(mysqli_num_rows($cek) > 0){
            header("Location: cafe-edit.php?c_id=".$cafeid."&status=f_f");
        }
        else{
            if($query = mysqli_query($connect, "INSERT INTO `facilities`(`cafe_id`, `facility_type`) VALUES ('$cafeid', '$fac')")){
                header("Location: cafe-edit.php?c_id=".$cafeid."");
            }
            else{
                echo "Gagal";
            }
        }
    }
?>