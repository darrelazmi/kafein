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
    if (isset($_POST["edit"])) {
        $id = $_SESSION["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $username = $_POST["username"];
        $profile_tmp = $_FILES["profile"]["tmp_name"];
        
        if($name == "" || $username == "" || $password == "" || $email == ""){
            header('Location: form-profile-edit.php?status=1');
        }
        else{
            if ($_SESSION["type"] == "owner") {
                $cek = mysqli_query($connect, "SELECT * FROM `owner` WHERE `owner_id` = '$id'");
                $data = mysqli_fetch_array($cek);
                $valid1 = 1;
                $valid2 = 1;
                if(!($data['username'] == $username)){
                    $cek1 = mysqli_query($connect, "SELECT * FROM `owner` WHERE `username` = '$username'");
                    if(mysqli_num_rows($cek1) == 1){
                        $valid1 = 0;
                    }
                }
                if(!($data['email'] == $email)){
                    $cek2 = mysqli_query($connect, "SELECT * FROM `owner` WHERE `email` = '$email'");
                    if(mysqli_num_rows($cek2) == 1){
                        $valid2 = 0;
                    }
                }

                if($valid1 == 0 || $valid2 == 0){
                    if($valid1 == 0 && $valid2 == 0){
                        header('Location: form-profile-edit.php?status=2');
                    }
                    elseif($valid1 == 0){
                        header('Location: form-profile-edit.php?status=3');
                    }
                    else{
                        header('Location: form-profile-edit.php?status=4');
                    }
                }
                else{
                    if($query = mysqli_query($connect,"UPDATE `owner` SET `name`='$name',`username`='$username',`password`='$password',`email`='$email' WHERE `owner_id`= '$id'")) {
                        move_uploaded_file($profile_tmp,"./profiles/owner/" . $id . ".jpg");
                        header("Location: profile.php");
                    }
                    else {
                        header("Location: error.php");
                    }
                }
            }
            elseif ($_SESSION["type"] == "customer") {
                if($query = mysqli_query($connect,"UPDATE `customer` SET `name`='$name',`username`='$username',`password`='$password',`email`='$email',`profile_photo`='$id' WHERE `customer_id`= '$id'")) {
                    move_uploaded_file($profile_tmp,"./profiles/customer/" . $id . ".jpg");
                    header("Location: profile.php");
                }
                else {
                    header("Location: error.php");
                }
            }

        }

    }
    else {
        header("Location: error.php");
    }
?>