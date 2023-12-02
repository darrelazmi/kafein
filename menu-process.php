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
        $menu = $_POST['nama_menu'];
        if($query = mysqli_query($connect, "DELETE FROM `menus` WHERE `cafe_id` = '$cafeid' AND `goods` = '$menu'")){
            header("Location: cafe-edit.php?c_id=".$cafeid."");
        }
        else{
            echo "Gagal";
        }
    }
    if(isset($_POST['add'])){
        $menu = $_POST['menu_baru'];
        $price = $_POST['harga'];
        $cek = mysqli_query($connect, "SELECT * FROM `menus` WHERE `cafe_id`='$cafeid' AND `goods`='$menu'");
        if(mysqli_num_rows($cek) > 0){
            header("Location: cafe-edit.php?c_id=".$cafeid."&status=f_m");
        }
        else{
            if($query = mysqli_query($connect, "INSERT INTO `menus`(`cafe_id`, `goods`, `price`) VALUES ('$cafeid', '$menu', '$price')")){
                header("Location: cafe-edit.php?c_id=".$cafeid."");
            }
            else{
                echo "Gagal";
            }
        }
    }
?>