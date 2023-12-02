<?php 
    include("config.php");
    session_start();
    if(!isset($_SESSION['id']) || $_SESSION['type'] == "customer"){
        session_destroy();
        header("refresh:3; url=index.php");
        die("Forbidden... Redirecting to home...");
    }
    else{
        $id = $_SESSION['id'];
        $type = $_SESSION['type'];
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Your Cafe</title>
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
            <!-- Logo and Add Cafe Button -->
            <div>
                <button class="btn btn-success btn-animate" onclick="document.location='form-cafe-add.php'">Add Cafe</button>
            </div>

            <!-- Title -->
            <h3 class="text-center">Your Cafe</h3>

            <!-- Profile and Logout Buttons -->
            <div>
                
            </div>
        </header>
        <?php
    if(isset($_SESSION["id"])){
        $id = $_SESSION["id"];
        $type = $_SESSION["type"];
        if ($type=='owner') {
            $query = mysqli_query($connect,"SELECT * FROM `cafe` WHERE `owner_id`='$id'");
            if(mysqli_num_rows($query) == 0){
                echo "<br>Anda belum menambahkan kafe. Tambahkan kafe anda terlebih dahulu";
            }
            else{
                echo "<table class = 'table table-hover'>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Lokasi</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";
                while($cafe = mysqli_fetch_array($query)){
                    echo "<tr>";
                    
                    echo "<td onclick='document.location=\"cafe-detail.php?c_id=" .$cafe['cafe_id']. "\"'.><b>" . $cafe['cafe_name'] . "</b><br>" . $cafe['description'] . "</td>";
                    echo "<td onclick='document.location=\"cafe-detail.php?c_id=" .$cafe['cafe_id']. "\"'.>".$cafe['kota']."</td>";
                    echo "<td><button class='btn btn-primary btn-sm' onclick='window.open(\"" . $cafe['alamat'] . "\", \"_blank\")'>Google Maps Here</button></td>";
                    echo "<td><button class='btn btn-primary btn-sm' onclick='window.location=\"cafe-edit.php?c_id=" . $cafe['cafe_id'] . "\"'>Edit</button></td>";             
                    echo "</tr>";
                    
                    }
                    
            }
        }
        else{
            # code...
        }
    }
    if(isset($_GET['status'])){
        if($_GET['status'] == 1){
            echo "Cafe berhasil ditambahkan<br>";
        }
    }
?>
        <!-- ... (rest of your content) ... -->
    </div>
</body>
</html>


