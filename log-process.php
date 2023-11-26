<?php
    session_start();
    include('config.php');

    if (isset($_POST['login'])) {

        #Ambil username ama pass dari POST
        $username = $_POST['username'];
        $password = $_POST['password'];


        #Untuk owner
        if ($_POST['type']=='owner') {
            $query = mysqli_query($connect, "SELECT `owner_id`,`password` FROM `owner` WHERE `username` = '$username' OR `email` = '$username'");
            //klu uname/email nya ga ketemu
            if(mysqli_num_rows($query) == 0){
                header('Location: login.php?status=falsename');
            }
            else{
                $data = mysqli_fetch_array($query);
                if ($data['password']==$password) {
                    $_SESSION['id']=$data['owner_id'];
                    $_SESSION['type']=$_POST['type'];
                    header('Location: mycafe.php');
                }
                else{
                    header('Location: login.php?status=falsepw');
                }
            }
        }

        #untuk customer
        elseif ($_POST['type']=='customer') {
            $query = mysqli_query( $connect, "SELECT customer_id, `password` FROM `customer` WHERE `username` = '$username' OR `email` = '$username'");
            //klu uname/email nya ga ketemu
            if(mysqli_num_rows($query) == 0){
                header('Location: login.php?status=falsename');
            }
            else{
                $data = mysqli_fetch_array($query);
                if ($data['password']==$password) {
                    $_SESSION['id']=$data['customer_id'];
                    $_SESSION['type']=$_POST['type'];
                    header('Location: find.php');
                }
                else{
                    header('Location: login.php?status=falsepw');
                }
            }
        }

        else {
            header('Location: error.php');
        }
        
    }
    else {
        header('Location: error.php');
    }
?>
