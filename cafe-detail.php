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
    if (isset($_GET['c_id'])) {
        $cafe_id = $_GET['c_id'];
        $query = mysqli_query($connect, "SELECT * FROM `cafe` WHERE `cafe_id` = '$cafe_id'");
        $data = mysqli_fetch_array($query);
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Detail</title>
</head>

<body>
	<header>
		<h3>Cafe Detail</h3>
		<button onclick="document.location='logout.php'">Logout</button>
	</header>
        <p>
            <img src="./profiles/cafe/<?php echo $cafe_id?>.jpg" alt="<?php echo $data['cafe_name']?>">
        </p>
		<p>
			<label for="nama">Cafe Name: <?php echo $data['cafe_name']?></label>
			
		</p>
		<p>
			<label for="description">Description: <?php echo $data['description']?></label>
			
		</p>
        <p>
			<label for="alamat">Address: <?php echo $data['alamat']?></label>
			
		</p>
        <p>
			<label for="kota">City: <?php echo $data['kota']?></label>
			
		</p>
		<p>
            <label for="fasilitas">Facilities: </label>
            <br>
			<?php
                $fac_id = $cafe_id;
                $fac = mysqli_query($connect, "SELECT * FROM facilities WHERE cafe_id = '$fac_id'");
                while($fasilitas = mysqli_fetch_array($fac)){
                    echo $fasilitas['facility_type'];
                    echo "<br>";
                }
            ?>
        </p>
        <p>
            <label for="menu">Menus: </label>
            <br>
            <?php
                $menu_id = $cafe_id;
                $menu = mysqli_query($connect, "SELECT * FROM menus WHERE cafe_id = '$menu_id'");
                while($daftar_menu = mysqli_fetch_array($menu)){
                    echo $daftar_menu['goods'];
                    echo " : Rp.";
                    echo $daftar_menu['price'];
                    echo "<br>";
                }
            ?>
			
		</p>
	<br>
    <?php
        if($type == "owner"){
            echo "<button onclick=\"document.location='cafe-edit.php?c_id=".$data['cafe_id']."'\">Edit Cafe</button>
            <br>";
            echo "<br><button onclick=\"document.location='cafe-delete.php?id=".$data['cafe_id']."'\">Delete Cafe</button>
            <br>";
        }
    ?>

	</body>
</html>
