<?php
    session_start();
    include('config.php');

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query;

        if ($_POST['type']=='owner') {
            $query = mysqli_query("SELECT 'owner_id','password' FROM 'owner' WHERE 'username' = '$username' OR 'email' = '$username'");
            $data = mysqli_fetch_array($query);
            if ($data['password']==$password) {
                $_SESSION['id']=$data['owner_id'];
            }
        }

        elseif ($_POST['type']=='customer') {
            $query = mysqli_query("SELECT 'owner_id','password' FROM 'owner' WHERE 'username' = '$username' OR 'email' = '$username'");
            $data = mysqli_fetch_array($query);
            if ($data['password']==$password) {
                $_SESSION['id']=$data['owner_id'];
            }
        }

        else {
            # code...
        }
        
    }
?>