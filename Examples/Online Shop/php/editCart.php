<?php
    require_once("db.php");
    require_once("../logging/Log.php");
    
    $db = new DB();
    $log = new Logger("editCart");
    session_start();
    $uID = $_SESSION["uID"];

    $id = 0;
    if(!isset($_POST["id"])){
        echo"0";
        die();
    }

    $id = $_POST["id"];
    $add = isset($_POST['add']);
    $log->info("Received $id : $add");

    if($add && $db->add2Cart($uID, $id) === true){
        $log->info("$id added to $uID's cart");
        echo"1";
        die();
    }elseif($add){
        echo"0";
        die();
    }

    $log->info("Removing $id");
    $result = $db->getCart($uID);

    if($result === -1){
        $log->info("Could not get cart string");
        echo"0";
        die();
    }

    $cart = explode(',', $result['cart']);

    if(!$cart){
        $log->warning("Could not explode cart");
        echo"0";
        die();
    }

    $count = count($cart);
    $log->info("Item count: $count");

    for($i = 0; $i < $count; $i++){
        $log->info("Checking: cart[$i]: " . $cart[$i]);
        if($cart[$i] === $id){
            $log->info("Removing: $i");
            unset($cart[$i]);
            break;
        }
    }

    $cart = implode(',', $cart);

    if($db->setCart($uID, $cart) === true){
        $log->info("Item removed from cart");
        echo"1";
    }else{
        $log->warning("Failed to remove item");
        echo"0";
    }