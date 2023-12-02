<?php
    session_start();
    include('config.php');
    if(!isset($_SESSION['id'])){
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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<title>Kaffein</title>
	<link rel="stylesheet" href="./assets/css/styles.css">
	<style>
        body {
            background: url('./assets/img/home1.png') no-repeat center center fixed;
            background-size: cover;
        }
		.containery {
            background-color: rgba(255, 255, 255, 0); /* Adding transparency */
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
	<div class="container-fluid">
		<div class="row d-flex justify-content-center">
			<div class="col-4" style="padding-top: 18vh;" >
				<p class="h1 text-white text-center">BE OUR GUEST</p>
			</div>
		</div>
		<div class="row d-flex justify-content-center">
			<div class="col-4">
				<p class="h5 bg-white text-center" style="color: #c9bdab;">FIND YOUR FAVORITE CAFE EASIER!</p>
			<div>
		</div>
	</div>


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
<form action="" method="GET">
	<fieldset>
	<div class="row g-0 text-center justify-content-center input-group mb-3">
	<div class="col-12 g-0 d-inline-flex align-items-center">
	<label class="input-group-text ms-auto" for="loc" style="width: 125px;" >Choose City</label>
  	<select  onchange="this.form.submit()" class="form-select form-select me-auto" id="loc" name="loc" style="width: 20vw;">
		<?php if($_GET['loc']=="NULL") echo '<option value="choose" selected>Select city...</option>'?>
    	<option value="all" <?php if($_GET['loc']=='all') echo "selected";?>>All</option>
    	<option value="bogor" <?php if($_GET['loc']=='bogor') echo "selected";?>>Bogor</option>
    	<option value="jakarta" <?php if($_GET['loc']=='jakarta') echo "selected";?>>Jakarta</option>
    	<option value="bekasi" <?php if($_GET['loc']=='bekasi') echo "selected";?>>Bekasi</option>
  	</select>
	</div>
	</div>
	</fieldset>
</form>
</body>
<body>
<div class="containery">

<?php
    $id = $_SESSION["id"];
    $type = $_SESSION["type"];
	$location = $_GET['loc'];
	if($location=='all') $query = mysqli_query($connect, "SELECT * FROM cafe");
	else $query = mysqli_query($connect, "SELECT * FROM cafe WHERE kota = '$location'");
    if(mysqli_num_rows($query) == 0){
        if($location != "NULL"){
			echo "Tidak ada cafe pada lokasi tersebut";
		}
    }
    else{
        echo "<table class = 'table table-hover'>
            <thead>
                <tr>
					<th></th>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>";
        while($cafe = mysqli_fetch_array($query)){
            echo "<tr>";
            
            echo "<td><img src=\"./profiles/cafe/".$cafe['profile_cafe'].".jpg\" alt=\"".$cafe['cafe_name']."\" style=\"max-height: 100px; display:block; margin-left:auto; margin-right:auto;\"></td>";             
            echo "<td onclick='document.location=\"cafe-detail.php?c_id=" .$cafe['cafe_id']. "\"'.><b>" . $cafe['cafe_name'] . "</b><br>" . $cafe['description'] . "</td>";
            echo "<td onclick='document.location=\"cafe-detail.php?c_id=" .$cafe['cafe_id']. "\"'.>".$cafe['kota']."</td>";
            echo "<td><button class='btn btn-primary btn-sm' onclick='window.open(\"" . $cafe['alamat'] . "\", \"_blank\")'>Google Maps Here</button></td>";
            echo "</tr>";
            
            }        
    }
?>

		</tbody>
	</table>
</div>
	</body>
</html>

