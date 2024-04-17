<?php
/*
TODO
validate user input
*/
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }else{
        session_destroy();
        session_start();
    }
    require_once("db.php");
    require_once "../logging/Log.php";
    $db = new DB();
    $log = new Logger("Login");

    
    if(isset($_POST["uname"]) && isset($_POST['pwd']) && !isset($_GET['invalid'])){
        $log->info("Starting Login: " . $_POST['uname']);
        if($db->getID($_POST['uname']) === -1){
            $log->info('Username does not exist');
            header('Location: login.php?invalid=1');
        }elseif(!$db->isVerified($_POST['uname'])){
            $log->info("User: " . $_POST['uname'] . " is not verified redirecting");
            header("Location: verify.php");
        }else{
            $id = $db->login($_POST['uname'], $_POST['pwd']);
            unset($_POST['uname']);
            unset($_POST['pwd']);
            if($id === -1){
                $log->info('User entered invalid credentials');
                header('Location: login.php?invalid=1');
            }else{
                $_SESSION['uID'] = $id;
                $log->info('uID=' . $_SESSION["uID"]);
                $db->createLoginCookie($id);
                header('Location: home.php');
            }
        }
    }elseif(isset($_GET["man"]) || isset($_GET['invalid'])){
        $log->info("Manual login");
    }
    elseif(isset($_COOKIE['token'])){
        $id = $db->getUserIdFromToken($_COOKIE['token']);
        if($db->checkCookies($_COOKIE['token'])){
            $_SESSION['uID'] = $id;
            $log->info('uID=' . $_SESSION["uID"]);
            header('Location: home.php');
        }
    }else{
        $log->info('Asking credentials');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login</title>
        <meta name="description" content="This is the login page for our example shop">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/login.css">
        <link rel='icon' href="../Icons/favico.ico" type="image/x-icon">
        <script src="../javascript/login.js"></script>
    </head>
    <body>
        <main>
            <div class="form">
                <form method="post" action="login.php">
                    <h1>Login</h1><br>

                    <?php if(isset($_GET["invalid"])):?>
                        <h2 class="invalid">Username or Password was incorrect</h2><br>
                    <?php endif;?>

                    <div class="inputDiv">
                        <label for="uname">User Name:<br><input type="text" id="uname" name="uname" autocomplete="username" placeholder="John"></label><br>
                    </div>
                    <div class="inputDiv">
                        <div class="pwdDiv">
                            <label for="pwd">Password:<br><input type="password" id="pwd" name="pwd" autocomplete="current-password" placeholder="********"></label>
                            <button id="pwdshow" type="button">Show</button><br>
                        </div>
                    </div>
                    <div class="buttons">
                        <button type="submit" value="Submit!">Submit</button>
                        <a href="register.php">Register</a><br>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>