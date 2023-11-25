<?php
session_start();
include('config.php');
if(!isset($_SESSION['id'])){
    session_unset();
    session_destroy();
    header("refresh:3; url=index.php");
    die("Forbidden... Redirecting to home...");
}
?>