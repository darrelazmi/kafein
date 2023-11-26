<?php
	include("config.php");
	session_start();
	if (isset($_SESSION["id"])) {
		$id = $_SESSION["id"];
		$type = $_SESSION["type"];
		if($type=="owner") $query = mysqli_query($connect,"SELECT `username` FROM `owner` WHERE `owner_id` = '$id'");
		elseif ($type=="customer") $query =	mysqli_query($connect,"SELECT `username` FROM `customer` WHERE `customer_id` = '$id'");
		else header("Location: error.php");
		$username = mysqli_fetch_array($query);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<title>Kaffein</title>
	<link rel="stylesheet" href="./assets/css/styles.css">
</head>
<body>
	<img class="bg-img" src="./assets/img/home1.png">
	<nav class="navbar navbar-expand-sm bg-black navbar-dark" style="--bs-bg-opacity: .3;">
		<div class="container">
			<a class="navbar-brand" href="index.php">KAFFEIN</a>
			<?php if(!isset($_SESSION['id'])): ?>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="register.php">Register</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="login.php">Login</a>
				</li>
			</ul>
			<?php endif; ?>
			<?php if(isset($_SESSION['id'])): ?>
			<ul class = "navbar-nav ms-auto">
				<li class="nav-item">
					<a class="navbar-link" href="profile.php">
						<img src="./profiles/<?php echo $type; ?>/<?php echo $id; ?>.jpg" alt="Avatar Logo" style="width:40px;height:40px;" class="rounded-pill">
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="profile.php">Welcome, <?php echo $username[0]; ?><a></span>
				</li>
			</ul>
			<?php endif; ?>
		</div>
	</nav>
</body>
</html>
