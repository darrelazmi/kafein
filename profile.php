<?php
    include('config.php');
    session_start();
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
	</header>

	<form action="profile-edit.php" method="POST" enctype="multipart/form-data">
		<fieldset>  
		<p>
			<label for="nama">Name: </label>
			<input type="text" name="name" placeholder="Full Name" />
		</p>
		<p>
			<label for="username">Username: </label>
			<input type="text" name="username" placeholder="Username" />
		</p>
		<p>
			<label for="password">Password: </label>
			<input type="password" name="password" placeholder="enter here" />
		</p>
        <p>
			<label for="email">Email: </label>
			<input type="text" name="email" placeholder="enter here" />
		</p>
        <p>
			<label for="profile">Profile: </label>
			<input type="file" name="profile" placeholder="upload foto" />
		</p>
		<p>
			<input type="submit" value="Edit" name="edit" />
		</p>
		</fieldset>
	</form>

	<button onclick="document.location='delete.php'">Delete Account</button>

	</body>
</html>
