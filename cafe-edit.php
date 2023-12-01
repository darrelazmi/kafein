<?php
    include('config.php');
    session_start();
	if(!isset($_SESSION['id'])){
        session_destroy();
        header("refresh:3; url=index.php");
        die("Forbidden... Redirecting to home...");
    }
    else{
        $id = $_SESSION['id'];
        $type = $_SESSION['type'];
    }
    if (isset($_GET['c_id']) && $type == "owner") {
        $cafe_id = $_GET['c_id'];
        $_SESSION['cafe_id'] = $cafe_id;
        $query = mysqli_query($connect, "SELECT * FROM `cafe` WHERE `cafe_id` = '$cafe_id'");
        $data = mysqli_fetch_array($query);
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Cafe</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <style>
        body {
            background: url('./assets/img/home1.png') no-repeat center center fixed;
            background-size: cover;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Adding transparency */
            border-radius: 15px;
            padding: 20px;
            margin-top: 60px;
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
    </style>
</head>

<body>
<div class="container">
	<header class="d-flex justify-content-between align-items-center mt-5">
         <!-- Logo and Add Cafe Button -->
         <div>
                <img src="./assets/img/3 crop.png" alt="Kaffein Logo" class="logo">
                <button class="btn btn-success btn-animate" onclick="document.location='mycafe.php'">My Cafe</button>
                <button class="btn btn-success btn-animate" onclick="document.location='cafe-detail.php?c_id=<?php echo $cafe_id?>'">Back to Cafe Detail</button>
            </div>
		<h3>Cafe Edit</h3>
		<button class="btn btn-secondary btn-animate" onclick="document.location='logout.php'">Logout</button>
	</header>
    <form action="cafe-edit-process.php" method="POST" enctype="multipart/form-data" autofill="off" autocomplete="off">
		<p>
			<label for="nama">Cafe Name: </label>
            <input type="text" name="name" value="<?php echo $data['cafe_name']?>"/>
			
		</p>
		<p>
			<label for="description">Description: </label>
			<input type="text" name="desc" value="<?php echo $data['description']?>"/>
		</p>
        <p>
			<label for="alamat">Address: </label>
            <input type="text" name="alamat" value="<?php echo $data['alamat']?>"/>
		</p>
        <p>
			<label for="kota">City: </label>
			<input type="text" name="city" value="<?php echo $data['kota']?>"/>
		</p>
        <p>
			<label for="profile">Cafe Profile: </label>
			<input type="file" name="profile" placeholder="upload foto" />
		</p>
        <p>
            <input type="submit" value="Update" name="update" />
        </p>
    </form>
    <?php if(isset($_GET['status'])): ?>
	<p>
		<?php
			if($_GET['status'] == '1'){
				echo "Semua kolom harus terisi.<br>\n";
			}
			
		?>
	</p>
	<?php endif; ?>
    <p>
        <label for="fasilitas">Facilities: </label>
        <br>
        <?php
                $fac_id = $cafe_id;
                $fac = mysqli_query($connect, "SELECT * FROM facilities WHERE cafe_id = '$fac_id'");
                while($fasilitas = mysqli_fetch_array($fac)){
                    echo '<form action="facility-process.php" method="POST" enctype="multipart/form-data" autofill="off" autocomplete="off">';
                    echo "<label>" .$fasilitas['facility_type']. "</label>";
                    echo "<input type=\"hidden\" name=\"fac\" value=\"" .$fasilitas['facility_type']. "\"/>";
                    echo " ";
                    echo "<input type=\"submit\" value=\"Delete\" name=\"hapus\" />";
                    echo "</form>";
                }
                ?>
        </p>
    <form action="facility-process.php" method="POST" enctype="multipart/form-data" autofill="off" autocomplete="off">
        <p>    
            <input type="text" name="fac_baru" placeholder="Facility"/>
            <input type="submit" value="Add" name="add" />
        <p>
    </form>
        <p>
            <label for="menu">Menus: </label>
            <br>
            <?php
                $menu_id = $cafe_id;
                $menu = mysqli_query($connect, "SELECT * FROM menus WHERE cafe_id = '$menu_id'");
                while($daftar_menu = mysqli_fetch_array($menu)){
                    echo '<form action="menu-process.php" method="POST" enctype="multipart/form-data" autofill="off" autocomplete="off">';
                    echo "<label>" .$daftar_menu['goods']. "</label>";
                    echo "<label> : Rp." .$daftar_menu['price']. "</label>";
                    echo "<input type=\"hidden\" name=\"nama_menu\" value=\"" .$daftar_menu['goods']. "\"/>";
                    echo "<input type=\"hidden\" name=\"harga\" value=\"" .$daftar_menu['price']. "\"/>";
                    echo " ";
                    echo "<input type=\"submit\" value=\"Delete\" name=\"hapus\" />";
                    echo "</form>";
                }
            ?>
			
		</p>
        <form action="menu-process.php" method="POST" enctype="multipart/form-data" autofill="off" autocomplete="off">
            <p>    
                <input type="text" name="menu_baru" placeholder="Menu"/>
                <input type="text" name="harga" placeholder="Price"/>
                <input type="submit" value="Add" name="add" />
            <p>
        </form>
	    <br>
	</body>
</html>
