<?php
	include("config.php");
	session_start();
	if (isset($_SESSION["id"])) {
		header("Location: find.php");
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
	<div class="container-fluid">
		<img class="row bg-img" src="./assets/img/home1.png" style="z-index:-1;">
		<div class="row d-flex justify-content-center">
			<div class="col-4" style="padding-top: 20vh;" >
				<p class="h1 text-white text-center">BE OUR GUEST</p>
			</div>
		</div>
		<div class="row d-flex justify-content-center">
			<div class="col-4">
				<p class="h5 bg-white text-center" style="color: #c9bdab;">FIND YOUR FAVORITE CAFE EASIER!</p>
			<div>
		</div>
		<div class="row justify-content-center align-items-center bg-white mt-5" style="border-radius: 25px;">
			<div class="col-12 pt-3">
				<p class="h6 text-center" style="color: #5a646e;">FIND YOUR FAVORITE CAFE NOW!</p>
			</div>
			<div class="col-12 pt-3">
				<p class="h6 text-center">Join the communities of coffee lovers and unlock a world of exclusive opportunities.</p>
			</div>
			<div class="col-12 pt-3 pb-3 text-center">
				<button type="button" class="btn btn-primary btn-md btn-block" onclick="document.location='login.php'">LOGIN HERE TO FIND YOUR CAFE</button>
			</div>
		</div>
	</div>


	<nav class="navbar navbar-expand-sm navbar-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="index.php">KAFFEIN</a> 
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      			<span class="navbar-toggler-icon"></span>
    		</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
					<a class="nav-link" href="register.php">Register</a>
					</li>
					<li class="nav-item">
					<a class="nav-link" href="login.php">Login</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

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
</html>