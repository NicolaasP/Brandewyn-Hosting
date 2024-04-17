<?php
require_once("db.php");
require_once("../logging/Log.php");

    session_start();
    $db = new DB();
    $log = new Logger("addToCart");
    $log->info("Adding to cart");
    if(!isset($_POST["item"]) || !isset($_SESSION['uID'])){
        $log->warning("itemID or uID not set");
        die();
    }

    $id = $_POST["item"];
    $uID = $_SESSION["uID"];

    if($db->add2Cart($uID, $id) !== -1){
        $log->info("Cart updated");
        echo"1";
    }else{
        $log->warning("Failed to update cart");
        echo"0";
    }
?>