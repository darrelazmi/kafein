<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="log-process.php" method="POST">
		<fieldset>
        <fieldset>
        <p>
			<label for="type">Login as: </label>
			<label><input type="radio" name="type" value="customer" checked> Customer</label>
			<label><input type="radio" name="type" value="owner"> Owner</label>
		</p>
        <p>
			<label for="username">Username: </label>
			<input type="text" name="username" placeholder="Username" />
		</p>
		<p>
			<label for="password">Password: </label>
			<input type="password" name="password" placeholder="Password" />
		</p>
        <p>
			<input type="submit" value="Login" name="login" />
		</p>
        </fieldset>

	</form>
</body>
</html>
<?php if(isset($_GET['status'])): ?>
	<p>
		<?php
			if($_GET['status'] == 'falsename'){
				echo "Username tidak ditemukan";
			}
			elseif($_GET['status'] == 'falsepw'){
				echo "Password yang anda masukkan salah";
			}
		?>
	</p>
<?php endif; ?>
