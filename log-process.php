<?php
    include('config.php');

    if (isset($_POST['login'])) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query;

        if ($_POST['type']=='owner') {
            $query = mysqli_query("SELECT 'password' FROM 'owner' WHERE 'username' = '$username' OR 'email' = '$username'");
            $data = mysqli_fetch_array()
        }

        elseif ($_POST['type']=='customer') {
            $query = mysqli_query("INSERT INTO `customer`(`name`, `username`, `password`, `email`, `profile_photo`) VALUES ('$name','$username','$password','$email','$profile')");
        }

        else {
            # code...
        }
        
    }
?>