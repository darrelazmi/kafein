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
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detail</title>
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
         <!-- Logo and Back Cafe Button -->
         <div>
                <img src="./assets/img/3 crop.png" alt="Kaffein Logo" class="logo">
                <button class="btn btn-success btn-animate" onclick="document.location='mycafe.php'">Back to My Cafe</button>
            </div>
		<h3>Cafe Detail</h3>
        <button class="btn btn-secondary btn-animate" onclick="document.location='logout.php'">Logout</button>
       
	</header>
        <p>
            <img src="./profiles/cafe/<?php echo $data['profile_cafe']?>.jpg" alt="<?php echo $data['cafe_name']?>">
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
