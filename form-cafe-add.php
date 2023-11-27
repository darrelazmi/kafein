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
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Cafe</title>
</head>

<body>
	<header>
		<h3>Add Cafe</h3>
	</header>

	<form action="cafe-add.php" method="POST" enctype="multipart/form-data" autofill="off" autocomplete="off">
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
			<label for="alamat">Address (Link Google Maps): </label>
			<input type="text" name="alamat" placeholder="Address" />
		</p>
        <p>
			<label for="profile">Cafe Profile: </label>
			<input type="file" name="profile" placeholder="upload foto" />
		</p>
		<p>
			<input type="submit" value="Add" name="tambah" />
		</p>
		</fieldset>
	</form>

	</body>
	<?php if(isset($_GET['status'])): ?>
	<p>
		<?php
			if($_GET['status'] == '1'){
				echo "Semua kolom harus terisi.<br>\n";
			}
			
		?>
	</p>
	<?php endif; ?>
</html>
