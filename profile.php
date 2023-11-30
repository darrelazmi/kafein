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
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<title>Kaffein</title>
	<link rel="stylesheet" href="./assets/css/styles.css">
</head>

<body>
	<header>
		<h3>Profile</h3>
		<button onclick="document.location='logout.php'">Logout</button>
	</header>
		<p>
            <img src='./profiles<?php 
			echo "/".$type."/".$data['profile_photo'].""
			?>.jpg' alt="<?php echo $data['name']?>" style="height: 250px; width: 250px;" class="rounded-pill" >
        </p>
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
