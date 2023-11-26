<?php
    session_start();
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $type = $_SESSION['type'];
        
    }
?>