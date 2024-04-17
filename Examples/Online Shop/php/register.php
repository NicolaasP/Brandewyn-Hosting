<?php
/*
TODO
Add email validated column
send validation email
*/
    session_destroy();
    session_start();
    require_once "db.php";
    require_once "../logging/Log.php";
    $log = new Logger("register");
    $log->info("starting registration");
    $db = new db();

    $log->info("session started");

    if(isset($_POST["uname"])){
        $uname = $_POST["uname"];
        $pwd = $_POST["pwd"];
        $email = $_POST["email"];
        $uID = $db->register($uname, $pwd, $email);
        if($uID === -1){
            $log->warning("Could not register user");
            die();
        }
        if(regEmail($email, $uID)){
            $log->info("User registered and verification sent");
            $_SESSION["uID"] = $uID;
            header("Location: home.php");
        }else{
            $log->warning("Could not send verification email");
        }
    }

    function regEmail($email, $uID){
        global $db, $log;
        $log->info("Sending verification email");
        $token = $db->getToken($uID);
        if($token === -1){
            $log->error("Could not send email verification token not set");
            return false;
        }

        $to = $email;
        $subject = "Please verify your email address";
        $message = "Click the link below to verify your email address:\n\n";
        $message .= "https://brandewynhosting.co.za/Examples/Online%20Shop/php/verify.php?token=" . $token;
        $headers = "From: noreply@brandewynhosting.co.za\r\n";
        $headers .= "Reply-To: noreply@brandewynhosting.co.za\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        return mail($to, $subject, $message, $headers);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="A page to register users for the shopping website">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/register.css">
        <link rel='icon' href="../Icons/favico.ico" type="image/x-icon">
        <script src="../javascript/register.js"></script>
    </head>
    <body>
        <main>
            <div class="form">
                <form action="register.php" method="post" id="reg">
                    <h1>Please enter your details below</h1><br>

                    <p id="unameE" class="eMsg"></p>

                    <div class="inputDiv">
                        <label for="uname">Username:<br>
                            <input id="uname"
                                    name="uname"
                                    class="em"
                                    type="text"
                                    autocomplete="username" 
                                    placeholder="Username" 
                                    max="20"
                                    min="5"
                                    size="20"
                                    required><br><br>
                        </label>
                    </div>

                    <div class="inputDiv">
                        <label for="email">Email:<br>
                            <input id="email"
                                    name="email"
                                    class="em"
                                    type="email"
                                    autocomplete="email" 
                                    placeholder="nicolaas@brandewynhosting.co.za" 
                                    max="100"
                                    min="3"
                                    size="20"
                                    required><br><br>
                        </label>
                    </div>

                    <div class="inputDiv">
                        <label for="pwd">Password:<br>
                            <div class="pwdDiv">
                                <input id="pwd"
                                        name="pwd"
                                        class="em"
                                        type="password"
                                        autocomplete="new-password"
                                        placeholder="Password"
                                        max="50"
                                        min="8"
                                        size="20"
                                        required>
                                        <button id='pwdshow' class='sB' type="button">Show</button>
                                        <br><br>
                            </div>
                        </label>
                    </div>

                    <div class="inputDiv">
                        <label for="pwd1">Confirm Password:<br>
                            <div class="pwdDiv">
                                <input id="pwd1"
                                        name="pwd1"
                                        class="em"
                                        type="password"
                                        autocomplete="new-password"
                                        placeholder="Confirm password"
                                        max="50"
                                        min="8"
                                        size="20"
                                        required>
                                        <button id='pwd1show' class='sB' type="button">Show</button>
                                        <br><br>
                            </div>
                        </label>
                    </div>

                    <div class="buttons">
                        <button id="submit" type="submit">Submit</button>
                        <a href="login.php?man=1" class="button">Back to Login</a>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>
