<?php
	session_start();
	if (isset($_SESSION["id"])) {
		$id = $_SESSION["id"];
		$type = $_SESSION["type"];
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
</head>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="--bs-bg-opacity: .3;">
		<div class="container-fluid">
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
			<ul class="navbar-nav">
				<a class="navbar-brand" href="index.php">coba
				
				</a>
				<li class="nav-item">
					<a href=""></a>
				</li>
			</ul>
			<?php endif; ?>
			</ul>
		</div>
	</nav>
	<div class="container-fluid">

	</div>
</body>
</html>


<!--
<?php if(isset($_GET['status'])): ?>
	<p>
		<?php
			if($_GET['status'] == 'sukses'){
				echo "Pendaftaran siswa baru berhasil!";
			} 
			else if($_GET['status'] == 'suksesedit'){
				echo "Edit berhasil!";
			}
			else if($_GET['status'] == 'gagaledit'){
				echo "Edit gagal!";
			}
			else {
				echo "Pendaftaran gagal!";
			}
		?>
	</p>
<?php endif; ?>
-->