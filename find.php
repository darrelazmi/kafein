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
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>

<body>
	<header>
		<h3>Find Cafe</h3>
        <h5>Input your location (city)</h5>
	</header>
    <button onclick="document.location='profile.php'">Profile</button>
    <br>
    <button onclick="document.location='logout.php'">Logout</button>
    <br><br>

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
	            		<th>Fasilitas</th>
	            		<th>Menu</th>
	            	</tr>
                </thead>
                <tbody>";
            while($cafe = mysqli_fetch_array($query)){
                echo "<tr>";
    
                echo "<td><b>" . $cafe['cafe_name'] . "</b><br>" . $cafe['description'] . "</td>";
                echo "<td>".$cafe['kota']."</td>";
                echo "<td>".$cafe['alamat']."</td>";

                echo "<td>";
                $fac_id = $cafe['cafe_id'];
                $fac = mysqli_query($connect, "SELECT * FROM facilities WHERE cafe_id = '$fac_id'");
                while($fasilitas = mysqli_fetch_array($fac)){
                    echo $fasilitas['facility_type'];
                    echo "<br>";
                }
                echo "</td>";
                
                echo "<td>";
                $menu_id = $cafe['cafe_id'];
                $menu = mysqli_query($connect, "SELECT * FROM menus WHERE cafe_id = '$menu_id'");
                while($daftar_menu = mysqli_fetch_array($menu)){
                    echo $daftar_menu['goods'];
                    echo " : Rp.";
                    echo $daftar_menu['price'];
                    echo "<br>";
                }
                echo "</td>";
    
                echo "</tr>";
    
                }
        }
    }
?>
    </tbody>
</table>
	</body>
</html>

