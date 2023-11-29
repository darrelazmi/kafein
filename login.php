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
    <title>Login Page</title>
    <link rel="stylesheet" href="./assets/css/login.css">
</head>
<body>
    <div class="wrapper">
        <div class="login-container">
            <form action="log-process.php" method="POST">
                <h2>Welcome Back!</h2>
				<div class="form-group">
                    <label for="type">Login as:</label>
                    <select name="type" id="type">
                        <option value="customer">Customer</option>
                        <option value="owner">Owner</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" value="Login" name="login">Login</button>

                <div class="register-link">
                    Don't have an account? <a href="register.php">Create an Account</a> <!-- Update href to your registration page -->
                </div>
            </form>
        </div>
    </div>
</body>
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
</html>
