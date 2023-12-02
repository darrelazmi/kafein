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
    <title>Edit Profile</title>
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
                    echo "<button class=\"btn btn-success btn-animate\" onclick=\"document.location='mycafe.php'\">My Cafe</button>";
                }
                else{
                    echo "<button class=\"btn btn-success btn-animate\" onclick=\"document.location='find.php?loc=NULL'\">Home</button>";
                }
                echo "<button class=\"btn btn-success btn-animate\" onclick=\"document.location='profile.php'\">Back to Profile</button>";
                ?>
            </div>
		<h3>Edit Profile</h3>
		<div></div>
	</header>

	<form action="profile-edit.php" method="POST" enctype="multipart/form-data" autofill="off" autocomplete="off">
		<fieldset>  
		<p>
			<label for="nama">Name: </label>
			<input type="text" name="name" value="<?php echo $data['name']?>" />
		</p>
		<p>
			<label for="username">Username: </label>
			<input type="text" name="username" value="<?php echo $data['username']?>" />
		</p>
		<p>
			<label for="password">Password: </label>
			<input type="password" name="password" value="<?php echo $data['password']?>" />
		</p>
        <p>
			<label for="email">Email: </label>
			<input type="text" name="email" value="<?php echo $data['email']?>" />
		</p>
        <p>
			<label for="profile">Profile: </label>
			<input type="file" name="profile" placeholder="upload foto" />
		</p>
		<p>
			<input type="submit" value="Update" name="edit" class="btn btn-success btn-animate" />
		</p>
		</fieldset>
	</form>
    <script>
		const navDown = document.querySelector('.navbar');
		window.addEventListener('scroll',() => {
			if (window.scrollY >= 56) {
				navDown.classList.add('navbar-scrolled');
			}else if(window.scrollY < 56) {
				navDown.classList.remove('navbar-scrolled');
			}
		});
	</script>
	</body>
	<?php if(isset($_GET['status'])): ?>
	<p>
		<?php
			if($_GET['status'] == '1'){
				echo "Semua kolom harus terisi.<br>\n";
			}
			elseif($_GET['status'] == '2'){
				echo "Username dan email sudah digunakan oleh pengguna lain.<br>\n";
			}
			elseif($_GET['status'] == '3'){
				echo "Username sudah digunakan oleh pengguna lain.<br>\n";
			}
			elseif($_GET['status'] == '4'){
				echo "Email sudah digunakan oleh pengguna lain.<br>\n";
			}
		?>
	</p>
	<?php endif; ?>
</html>
