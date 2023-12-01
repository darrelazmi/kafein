<?php
    include('config.php');
    session_start();
	if(!isset($_SESSION['id']) || $_SESSION['type'] == "customer"){
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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Cafe</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <style>
        /* ... (insert similar CSS as in the Your Cafe page) ... */
		body {
            background: url('./assets/img/home1.png') no-repeat center center fixed;
            background-size: cover;
        }
        .containery {
            background-color: rgba(255, 255, 255, 0.8);
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
        form {
            width: 100%;
            max-width: 500px;
            margin: auto;
        }
        form p {
            margin-bottom: 15px;
        }
        input[type="text"], input[type="file"], input[type="submit"] {
            width: 100%;
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
				<li class="nav-item">
					<a class="navbar-link" href="profile.php">
						<img src="./profiles/<?php echo $type; ?>/<?php echo $profile_photo[0]; ?>.jpg" alt="Avatar Logo" style="width:40px;height:40px;" class="rounded-pill">
					</a>
				</li>
				<li class="nav-item d-none d-sm-block">
					<a class="nav-link" href="profile.php">Welcome, <?php echo $username[0]; ?><a></span>
				</li>
				<li class="nav-item d-none d-sm-block">
				<button class="btn btn-secondary btn-animate" onclick="document.location='logout.php'">Logout</button>
				</li>
			</ul>
		</div>
	</nav>
	<div class="containery">
	<header class="text-center mt-5">
		<h3>Add Cafe</h3>
	</header>
	<form action="cafe-add.php" method="POST" enctype="multipart/form-data" autofill="off" autocomplete="off" class="mt-4">
		<fieldset>  
		<p>
			<label for="nama">Name: </label>
			<input type="text" name="name" placeholder="Cafe Name" />
		</p>
		<p>
			<label for="deskripsi">Description: </label>
			<input type="text" name="desc" placeholder="Description" />
		</p>
		<p>
			<label for="city">Location (City): </label>
			<input type="text" name="city" placeholder="City" />
		</p>
        <p>
			<label for="alamat">Address (Link to Google Maps): </label>
			<input type="text" name="alamat" placeholder="Address" />
		</p>
        <p>
			<label for="profile">Cafe Profile: </label>
			<input type="file" name="profile" placeholder="upload foto"/>
		</p>
		<p>
			<input type="submit" value="Add" name="tambah" class="btn btn-success btn-animate" />
		</p>
		</fieldset>
	</form>

    <button class="btn btn-secondary btn-animate" onclick="document.location='mycafe.php'">Back to My Cafe</button> 

	</body>
	<?php if(isset($_GET['status'])): ?>
	<p class="text-center">
		<?php
			if($_GET['status'] == '1'){
				echo "Semua kolom harus terisi.<br>\n";
			}
			
		?>
	</p>
	<?php endif; ?>
		</div>
</html>
