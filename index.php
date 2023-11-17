<?php if(isset($_GET['status'])): ?>

    include('config.php');
<p>
	<?php
		if($_GET['status'] == 'sukses'){
			echo "Pendaftaran siswa baru berhasil!";
		} 
		else if($_GET['status'] == 'suksesedit'){
			echo "Edit berhasil!";
		}
		else if($_GET['status'] == 'gagaledit'){
			echo "Edit gagal!";
		}
		else {
			echo "Pendaftaran gagal!";
		}
	?>
</p>

<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php if(isset($_GET['status'])): ?>
	<p>
		<?php
			if($_GET['status'] == 'failed'){
				echo "Semangaat!";
			} 
		?>
	</p>
<?php endif; ?>


</body>
</html>


