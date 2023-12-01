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
        if($type=='owner') $user = mysqli_query($connect,"SELECT username FROM $type WHERE `owner_id` = '$id'");
        else if($type=='customer') $user = mysqli_query($connect,"SELECT username FROM $type WHERE `customer_id` = '$id'");
        else header("Location: error.php");
		if($type=='owner') $foto = mysqli_query($connect,"SELECT profile_photo FROM $type WHERE `owner_id` = '$id'");
        else if($type=='customer') $foto = mysqli_query($connect,"SELECT profile_photo FROM $type WHERE `customer_id` = '$id'");
        $profile_photo = mysqli_fetch_array($foto);
		$username = mysqli_fetch_array($user);
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
        .containery {
            background-color: rgba(255, 255, 255, 0.8); /* Adding transparency */
            border-radius: 15px;
            padding: 20px;
            margin-top: 80px;
            margin-left: 40px;
            margin-right: 40px;
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
<nav class="navbar navbar-expand-sm navbar-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="index.php">
				<img src="./assets/img/3 crop.png" alt="KAFFEIN" class="logo" style="max-height: 40px; padd">
			</a>
			<ul class = "navbar-nav ms-auto">
				<li class="nav-item">
					<a class="navbar-link" href="profile.php">
						<img src="./profiles/<?php echo $type; ?>/<?php echo $profile_photo[0]; ?>.jpg" alt="Avatar Logo" style="width:40px;height:40px;" class="rounded-pill">
					</a>
				</li>
				<li class="nav-item d-none d-sm-block">
					<a class="nav-link" href="profile.php">Welcome, <?php echo $username[0]; ?><a></span>
				</li>
				<li class="nav-item d-none d-sm-block">
				<button class="btn btn-secondary btn-animate" onclick="document.location='logout.php'">Logout</button>
				</li>
			</ul>
		</div>
	</nav>
<div class="containery">
	<header class="d-flex justify-content-between align-items-center mt-5">
         <!-- Logo and Back Cafe Button -->
         <div>
                <?php
                if($type=="owner"){
                    echo "<button class=\"btn btn-success btn-animate\" onclick=\"document.location='mycafe.php'\">Back to My Cafe</button>";
                }
                else{
                    echo "<button class=\"btn btn-success btn-animate\" onclick=\"document.location='find.php?loc=NULL'\">Back to Home</button>";
                }
                ?>
            </div>
		<h3>Cafe Detail</h3>
       <div></div>
       
	</header>
        <p>
            <img src="./profiles/cafe/<?php echo $data['profile_cafe']?>.jpg" alt="<?php echo $data['cafe_name']?> " style="max-height: 250px;">
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
        <p>
            <label for="fasilitas">Reviews: </label>
            <br>
			<?php
                $cid = $cafe_id;
                $uid = $id;
                $rev = mysqli_query($connect, "SELECT * FROM reviews WHERE cafe_id = '$cid'");
                while($ulas = mysqli_fetch_array($rev)){
                    $rev_id = $ulas['customer_id'];
                    $cari = mysqli_query($connect, "SELECT `username` FROM `customer` WHERE `customer_id` = '$rev_id'");
                    $uname = mysqli_fetch_array($cari);
                    echo "".$uname[0]." : ";
                    echo $ulas['review'];
                    echo "<br>";
                }
            ?>
        </p>
	<br>
    <?php
        if($type == "owner"){
            echo "<button class=\"btn btn-primary btn-animate\" onclick=\"document.location='cafe-edit.php?c_id=".$data['cafe_id']."'\">Edit Cafe</button>
            <br>";
            echo "<br><button class=\"btn btn-danger btn-animate\" onclick=\"document.location='cafe-delete.php?id=".$data['cafe_id']."'\">Delete Cafe</button>
            <br>";
        }
        else{
            if(isset($_POST['tambah'])){
                echo "<form action=\"review-add.php?c_id=".$cafe_id."\" method=\"POST\">";
                echo "<input type=\"text\" name=\"review_text\" placeholder=\"Review\"/>";
                echo "<input type=\"submit\" value=\"Post\" name=\"tambah\" class=\"btn btn-success btn-animate\" />";
                echo "<input type=\"submit\" value=\"Cancel\" name=\"batal\" class=\"btn btn-secondary btn-animate\" />";
                echo "</form>";
            }
            else{
                if($q = mysqli_query($connect, "SELECT * FROM `reviews` WHERE `cafe_id` = '$cafe_id' AND `customer_id` = '$id'")){
                    if(mysqli_num_rows($q) > 0){
                        $q_dat = mysqli_fetch_array($q);
                        echo "<label>Your review: </label>";
                        echo "<br>".$q_dat['review']."";
                        echo "<button class=\"btn btn-danger btn-animate\" onclick=\"document.location='review-delete.php?c_id=".$cafe_id."'\">Delete Review</button>";
                    }
                    else{
                        echo "<form action=\"\" method=\"POST\">";
                        echo "<input type=\"submit\" value=\"Post Review\" name=\"tambah\" class=\"btn btn-success btn-animate\" />";
                        echo "</form>";
                    }
                }
                else{
                    echo "<form action=\"\" method=\"POST\">";
                    echo "<input type=\"submit\" value=\"Post Review\" name=\"tambah\" class=\"btn btn-success btn-animate\" />";
                    echo "</form>";
                }
            }
        }
    ?>

	</body>
</html>