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
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Your Cafe</title>
</head>

<body>
	<header>
		<h3>Your Cafe</h3>
	</header>
    <button onclick="document.location='profile.php'">Profile</button>
    <br>
    <button onclick="document.location='logout.php'">Logout</button>
    <br>
    <button onclick="document.location='form-cafe-add.php'">Add Cafe</button>
	</body>
</html>
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


