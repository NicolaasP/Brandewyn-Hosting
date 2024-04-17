<?php
    if(session_status()==PHP_SESSION_NONE)session_start();

    ini_set('display_errors',   1);
    ini_set('display_startup_errors',   1);
    error_reporting(E_ALL);

    require_once("db.php");
    require_once("../logging/Log.php");
    $db = new DB();
    $log = new Logger("Verify");
    $log->info("Verifying user");


    $failed = '<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Could not verify</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/verify.css">
        <link rel="icon" href="../Icons/favico.ico" type="image/x-icon">
    </head>
    <body>
        <h1>Your email address could not be verified</h1>
        <br>
        <h2>An email has been sent to the website admin</h2>
        <div class="contact">
            <h2>Contact info</h2>
            <h3>Name: Nicolaas Ivan Pretorius</h3>
            <h3>Email: nicolaas@brandewynhosting.co.za</h3>
            <h3>Phone: +27 62 391 1953</h3>
        </div>
    </body>
</html>';

    $success = '<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Verified</title>
            <meta name="description" content="">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="../css/verify.css">
            <link rel="icon" href="../Icons/favico.ico" type="image/x-icon">
        </head>
        <body>
            <h1>Thank you for verifing your email address</h1>
            <a href="home.php" class="home">Home Page</a>
        </body>
    </html>';



    if(isset($_GET["dev"])){
        if($_GET["dev"]== "s"){echo $success;}
        else{echo $failed;}
        die();
    }
            

    if(isset($_GET["token"])){
        $token = $_GET["token"];
        if(!$db->checkCookies($token , true)){
            $log->warning("Failed token check");
            echo $failed;
            die();
        }

        $id = $db->getUserIdFromToken($token);
        if($id === -1){
            $log->warning("Failed to get id from token: $token");
            echo $failed;
            die();
        }
        if(!$db->verify($id)){
            $log->warning("Could not verify: $id");
            echo $failed;
            die();
        }
        $log->info("Successfully verified: $id");
        $_SESSION["uID"] = $id;
        echo $success;
    }else{
        echo $failed;
    }
?>

