<?php
session_start();
include('config.php');
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./assets/css/login.css">
</head>
<body>
    <div class="wrapper">
        <div class="login-container">
            <form action="reg-process.php" method="post"> <!-- Update the action to your registration script -->
                <h2>Register</h2>
                <div class="form-group">
                    <label for="type">Register as:</label>
                    <select name="type" id="type">
                        <option value="customer">Customer</option>
                        <option value="owner">Owner</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" value="Register" name="register">Register</button>

                <div class="login-link">
                    Already have an account? <a href="login.php">Login</a> <!-- Update href to your login page -->
                </div>
            </form>
        </div>
    </div>
	<?php if(isset($_GET['status'])): ?>
	<p>
		<?php
			if($_GET['status'] == '1'){
				echo "Semua kolom harus terisi.<br>\n";
			}
		?>
	</p>
	<?php endif; ?>
	<?php if(isset($_GET['username']) && isset($_GET['email'])): ?>
	<p>
		<?php
			if($_GET['username'] == 'false'){
				echo "Username sudah terdaftar.<br>\n";
			}
			if($_GET['email'] == 'false'){
				echo "Email sudah terdaftar.<br>\n";
			}
			if($_GET['username'] == 'false' || $_GET['email'] == 'false'){
				echo "Silahkan coba kembali.<br>\n";
			}
		?>
	</p>
	<?php endif; ?>

	</body>
</html>
