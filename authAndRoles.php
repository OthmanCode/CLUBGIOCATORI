<?php

function requireAuthenticated(){
    if(!isset($_SESSION["id"])){
        header("Location: login.php");
        exit();
    }
}



?>