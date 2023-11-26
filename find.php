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

