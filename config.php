<?php
    $db_host    = 'localhost';
    $db_user    = 'root';
    $db_pass    = '';
    $db_name    = 'kafein';
    $connect    = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$connect)
    {
        die("Koneksi Gagal");
    }
?>