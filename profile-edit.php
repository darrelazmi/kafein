<?php
    include("config.php");
    session_start();
    if (isset($_POST["edit"])) {
        $id = $_SESSION["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $username = $_POST["username"];
        $profile_tmp = $_FILES["profile"]["tmp_name"];
        if ($_SESSION["type"] == "owner") {
            if($query = mysqli_query($connect,"UPDATE `owner` SET `name`='$name',`username`='$username',`password`='$password',`email`='$email' WHERE `owner_id`= '$id'")) {
                move_uploaded_file($profile_tmp,"./profiles/owner/" . $id . ".jpg");
                header("Location: profile.php");
            }
            else {
                header("Location: error.php");
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
    else {
        header("Location: error.php");
    }
?>