<!DOCTYPE html>
<html>
<head>
	<title>Kafein | Test Page</title>
</head>

<body>
	<header>
		<h3>Register dan Login</h3>
		<h1>Kafein | Test Page</h1>
	</header>

	<h4>Menu</h4>
	<nav>
		<ul>
			<li><a href="register.php">Register</a></li>
			<li><a href="login.php">Login</a></li>
		</ul>
	</nav>


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

	</body>
</html>
