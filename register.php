<!DOCTYPE html>
<html>
<head>
	<title>Register New User</title>
</head>

<body>
	<header>
		<h3>Register</h3>
	</header>

	<form action="reg-process.php" method="POST">
		<fieldset>
        <p>
			<label for="type">I am registering as: </label>
			<label><input type="radio" name="type" value="customer" checked> Customer</label>
			<label><input type="radio" name="type" value="owner"> Owner</label>
		</p>
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
			<input type="file" name="profile" placeholder="enter here" />
		</p>
		<p>
			<input type="submit" value="Register" name="register" />
		</p>
		</fieldset>
	</form>

	<?php if(isset($_GET['username']) && isset($_GET['email'])): ?>
	<p>
		<?php
			if($_GET['username'] == 'false'){
				echo "Username sudah terdaftar";
			}
			if($_GET['email'] == 'false'){
				echo "Email sudah terdaftar";
			}
			if($_GET['username'] == 'false' || $_GET['email'] == 'false'){
				echo "Silahkan coba kembali";
			}
		?>
	</p>
	<?php endif; ?>

	</body>
</html>
