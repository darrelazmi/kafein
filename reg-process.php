<?php
    include('config.php');

    if (isset($_POST['register'])) {
    
        #Menerima dari POST
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $profile = $_FILES['profile']['tmp_name'];

        if($name == "" || $username == "" || $password == "" || $email == ""){
            header('Location: register.php?status=1');
        }
        else{
            #untuk owner
            if ($_POST['type']=='owner') {
    
                #cek email sama username udah dipeke?
                $query = mysqli_query($connect,"SELECT COUNT(email) AS `jumlah`  FROM `owner` WHERE email = '$email' ");
                $query2 = mysqli_query($connect,"SELECT COUNT(username) AS `jumlah`  FROM `owner` WHERE username = '$username'");
                $cek = mysqli_fetch_array($query);
                $cek2 = mysqli_fetch_array($query2);
    
                #kalau bener
                if ($cek['jumlah'] == 0 && $cek2['jumlah']==0) {
                    if($sukses = mysqli_query($connect, "INSERT INTO `owner`(`name`, `username`, `password`, `email`, `profile_photo`) VALUES ('$name','$username','$password','$email','$id')")){
                        move_uploaded_file($profile,"./profiles/owner/" . $id);
                        header('Location: login.php');
                    }
                    else {
                        header('Location: index.php?status=failed');
                    }
                }
    
                #kalau dah ada username
                elseif ($cek['jumlah'] != 0 && $cek2['jumlah'] != 0) {
                    header('Location: register.php?username=false&email=false');
                }
    
                #kalau dah ada email
                elseif($cek2['jumlah']==0){
                    header('Location: register.php?username=true&email=false');
                }
    
                #kalau dah ada username
                else{
                    header('Location: register.php?username=false&email=true');
                }
            }
    
            #untuk customer
            elseif ($_POST['type']=='customer') {
    
                #cek email sama username udah dipeke?
                $query = mysqli_query($connect,"SELECT COUNT(*) AS `jumlah`  FROM `customer` WHERE email = '$email'");
                $query2 = mysqli_query($connect,"SELECT COUNT(*) AS `jumlah`  FROM `customer` WHERE username = '$username'");
                $cek = mysqli_fetch_array($query);
                $cek2 = mysqli_fetch_array($query2);
    
                #kalau bener
                if ($cek['jumlah'] == 0 && $cek2['jumlah']==0) {
                    if($sukses = mysqli_query($connect, "INSERT INTO `customer`(`name`, `username`, `password`, `email`, `profile_photo`) VALUES ('$name','$username','$password','$email','$id')")){
                        move_uploaded_file($profile,"./profiles/customer/" . $id);
                        header('Location: login.php');
                    }
                    else {
                        header('Location: index.php?status=failed');
                    }
                }
    
                #kalau dah ada username
                elseif ($cek['jumlah'] != 0 && $cek2['jumlah'] != 0) {
                    header('Location: register.php?username=false&email=false');
                }
    
                #kalau dah ada email
                elseif($cek2['jumlah']==0){
                    header('Location: register.php?username=true&email=false');
                }
    
                #kalau dah ada username
                else{
                    header('Location: register.php?username=false&email=true');
                }
            }
    
            else {
                header('Location: error.php');
            }
        }


    }
?>