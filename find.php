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
</head>

<body>
<div class="container-fluid">
		<img class="row bg-img" src="./assets/img/home1.png" style="z-index:-1;">
		<div class="row d-flex justify-content-center">
			<div class="col-4" style="padding-top: 20vh;" >
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
			<a class="navbar-brand" href="index.php">KAFFEIN</a>
			<ul class = "navbar-nav ms-auto">
				<li class="nav-item">
					<a class="navbar-link" href="profile.php">
						<img src="./profiles/<?php echo $type; ?>/<?php echo $id; ?>.jpg" alt="Avatar Logo" style="width:40px;height:40px;" class="rounded-pill">
					</a>
				</li>
				<li class="nav-item d-none d-sm-block">
					<a class="nav-link" href="profile.php">Welcome, <?php echo $username[0]; ?><a></span>
				</li>
			</ul>
		</div>
	</nav>

	<form action="" method="POST">
		<fieldset>
		<p>
			<input type="text" name="loc" placeholder="City" />
			<input type="submit" value="Find" name="find" />
		</p>
		</fieldset>
    </form>
<?php
    if(isset($_POST['find'])){
        $location = $_POST['loc'];
        $query = mysqli_query($connect, "SELECT * FROM cafe WHERE kota = '$location'");
        if(mysqli_num_rows($query) == 0){
            echo "Tidak ada cafe pada lokasi tersebut";
        }
        else{
            echo "<table border = '1'>
                <thead>
                    <tr>
	            		<th>Nama</th>
	            		<th>Lokasi</th>
                        <th>Alamat</th>
	            	</tr>
                </thead>
                <tbody>";
            while($cafe = mysqli_fetch_array($query)){
                echo "<tr onclick='document.location=\"cafe-detail.php?c_id=" .$cafe['cafe_id']. "\"'.>";
    
                echo "<td><b>" . $cafe['cafe_name'] . "</b><br>" . $cafe['description'] . "</td>";
                echo "<td>".$cafe['kota']."</td>";
                echo "<td>".$cafe['alamat']."</td>";

                echo "</tr>";
    
                }
        }
    }
?>
    </tbody>
</table>
	</body>
</html>

