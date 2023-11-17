<?php
    include('config.php');

    if (isset($_POST['register'])) {
    
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $profile = $_POST['profile'];
        $query;

        if ($_POST['type']=='owner') {
            $query = mysqli_query($connect, "INSERT INTO `owner`(`name`, `username`, `password`, `email`, `profile_photo`) VALUES ('$name','$username','$password','$email','$profile')");
        }

        elseif ($_POST['type']=='customer') {
            $query = mysqli_query($connect, "INSERT INTO `customer`(`name`, `username`, `password`, `email`, `profile_photo`) VALUES ('$name','$username','$password','$email','$profile')");
        }

        else {
            
        }

        if ($query) {
            header('Location: login.php');
        }
        else {
            header('Location: index.php?status=failed')
        }
    }
?>