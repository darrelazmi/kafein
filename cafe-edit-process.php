<?php
    include("config.php");
    session_start();
    if(!isset($_SESSION['id']) && $_SESSION['type'] == 'customer'){
        session_unset();
        session_destroy();
        header("refresh:3; url=index.php");
        die("Forbidden... Redirecting to home...");
    }
    else{
        $id = $_SESSION['id'];
        $type = $_SESSION['type'];
        $cafeid = $_SESSION['cafe_id'];
    }
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $description = $_POST['desc'];
        $city = $_POST['city'];
        $address = $_POST['alamat'];
        $profile = $_FILES['profile']['tmp_name'];
        
        if($name == "" || $description == "" || $city == "" || $address == ""){
            header('Location: cafe-edit.php?c_id='.$cafeid.'&status=1');
        }
        else{
            if($query = mysqli_query($connect, "UPDATE `cafe` SET `cafe_name`='$name',`kota`='$city',`description`='$description',`alamat`='$address' WHERE `cafe_id`= '$cafeid'")) {
                if(isset($profile)){
                    $query2 = mysqli_query($connect, "UPDATE `cafe` SET `profile_cafe`='$cafeid' WHERE `cafe_id`='$cafeid'");
                    move_uploaded_file($profile,"./profiles/cafe/" . $cafeid . ".jpg");
                }
                header("Location: cafe-detail.php?c_id=".$cafeid."");
            }
            else {
                header("Location: error.php");
            }
        }

    }
    else {
        header("Location: error.php");
    }
?>