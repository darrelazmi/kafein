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
    }
    if (isset($_SESSION['id'])) {

        #Ambil ID dari session sama tipe pengguna
        $id = $_SESSION['id'];
        $type = $_SESSION['type'];

        #query semua data untuk profile
        if ($_SESSION['type']=="owner") {
            $query = mysqli_query($connect, "SELECT `name`, `username`, `password`, `email`, `profile_photo` FROM `owner` WHERE `owner_id`='$id'");
            $data = mysqli_fetch_array($query);
        }
        elseif($_SESSION['type']=="customer"){
            $query = mysqli_query($connect, "SELECT `name`, `username`, `password`, `email`, `profile_photo` FROM `customer` WHERE `customer_id` = '$id'");
            $data = mysqli_fetch_array($query);
        }
        else {
            header('Location: error.php');
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
</head>

<body>
	<header>
		<h3>Profile</h3>
		<button onclick="document.location='logout.php'">Logout</button>
	</header>

		<p>
			<label for="nama">Name: <?php echo $data['name']?></label>
			
		</p>
		<p>
			<label for="username">Username: <?php echo $data['username']?></label>
			
		</p>
        <p>
			<label for="email">Email: <?php echo $data['email']?></label>
			
		</p>
		<p>
			<label for="tipe">Tipe Akun: 
			<?php 
			if($type == 'owner'){
				echo "Owner";
			}
			else{
				echo "Customer";
			}
			?>
			</label>
			
		</p>
	<br>
	<button onclick="document.location='form-profile-edit.php'">Edit Account</button>
	<br><br>
	<button onclick="document.location='delete.php'">Delete Account</button>

	</body>
</html>
