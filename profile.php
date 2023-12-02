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
		if($type=='owner') $user = mysqli_query($connect,"SELECT username FROM $type WHERE `owner_id` = '$id'");
        else if($type=='customer') $user = mysqli_query($connect,"SELECT username FROM $type WHERE `customer_id` = '$id'");
        else header("Location: error.php");
		if($type=='owner') $foto = mysqli_query($connect,"SELECT profile_photo FROM $type WHERE `owner_id` = '$id'");
        else if($type=='customer') $foto = mysqli_query($connect,"SELECT profile_photo FROM $type WHERE `customer_id` = '$id'");
        $profile_photo = mysqli_fetch_array($foto);
		$username = mysqli_fetch_array($user);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>My Profile</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <style>
        body {
            background: url('./assets/img/home1.png') no-repeat center center fixed;
            background-size: cover;
        }
        .containery {
            background-color: rgba(255, 255, 255, 0.8); /* Adding transparency */
            border-radius: 15px;
            padding: 20px;
            margin-top: 80px;
            margin-left: 40px;
            margin-right: 40px;
        }
        @keyframes fadeInOut {
            0%,100% { opacity: 0.5; }
            50% { opacity: 1; }
        }
        .btn:hover {
            transform: scale(1.05);
            transition: transform 0.2s;
        }
        .btn:active {
            transform: scale(0.95);
        }
    </style>
</head>


<body>
<nav class="navbar navbar-expand-sm navbar-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="index.php">
				<img src="./assets/img/3 crop.png" alt="KAFFEIN" class="logo" style="max-height: 40px; padd">
			</a>
			<ul class = "navbar-nav ms-auto">
				<li class="nav-item d-none d-sm-block">
				<button class="btn btn-secondary btn-animate" onclick="document.location='logout.php'">Logout</button>
				</li>
			</ul>
		</div>
	</nav>
	<div class="containery">
	<header class="d-flex justify-content-between align-items-center mt-5">
		 <!-- Logo and Back Cafe Button -->
		 <div>
                <?php
                if($type=="owner"){
                    echo "<button class=\"btn btn-success btn-animate\" onclick=\"document.location='mycafe.php'\">Back to My Cafe</button>";
                }
                else{
                    echo "<button class=\"btn btn-success btn-animate\" onclick=\"document.location='find.php?loc=NULL'\">Back to Home</button>";
                }
                ?>
            </div>
	<h3>Profile</h3>
		<div></div>
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
	<button class="btn btn-primary btn-animate" onclick="document.location='form-profile-edit.php'">Edit Profile</button>
	<br><br>
	<button class="btn btn-danger btn-animate" onclick="document.location='delete.php'">Delete Account</button>

	</body>
</html>
