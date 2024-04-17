<?php
    require_once("db.php");
    require_once("../logging/Log.php");
    $db = new DB();
    $log = new Logger("acceptCookies");

    if(isset($_POST["accept"]) && $_SESSION["uID"]){
        $log->info("User: " . $_SESSION['uID'] . " accepted cookies");
        if($db->acceptCookies($_SESSION["uID"])){
            $log->info("Cookie accepted successfully");
        }else{
            $log->warning("Failed to accept cookies");
        }
    }else{
        $log->info("User denied cookies");
    }
?>