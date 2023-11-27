<?php
    include('config.php');
    session_start();
	if(!isset($_SESSION['id']) || $_SESSION['type'] == "customer"){
        session_destroy();
        header("refresh:3; url=index.php");
        die("Forbidden... Redirecting to home...");
    }
    else{
        $id = $_SESSION['id'];
        $type = $_SESSION['type'];
    }
    if (isset($_POST['tambah'])) {
    
        #Menerima dari POST
        $name = $_POST['name'];
        $description = $_POST['desc'];
        $city = $_POST['city'];
        $address = $_POST['alamat'];
        $profile = $_FILES['profile']['tmp_name'];

        if($name == "" || $description == "" || $city == "" || $address == ""){
            header('Location: form-cafe-add.php?status=1');
        }
        else{
            if($query = mysqli_query($connect, "INSERT INTO `cafe`(`owner_id`,`kota`,`cafe_name`,`description`,`profile_cafe`,`alamat`) VALUES ('$id','$city','$name','$description','$id','$address')")){
                move_uploaded_file($profile,"./profiles/cafe/" . $id);
                header('Location: mycafe.php?status=1');
            }
            else {
                header('Location: error.php');
            }
        }


    }
?>