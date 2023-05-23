<?php

session_start();

//redirect if not logged
if(!isset($_SESSION["id"])){
    header("Location: login.php");
    exit();
}


?>