<?php
require_once("db.php");
require_once("../logging/Log.php");
$log = new Logger("userExists");

$log->info("Checking if username is taken");

if (isset($_POST['uname'])) {
    $db = new db();
    $uname = $_POST['uname'];
    $exists = $db->userExists($uname);
    $log->info('username validity: ' . $exists);
    echo $exists ? 'exists' : 'not_exists';
}elseif (isset($_POST['email'])) {
    $db = new db();
    $email = $_POST['email'];
    $exists = $db->emailExists($email);
    $log->info('email validity: ' . $exists);
    echo $exists ? 'exists' : 'not_exists';
}
?>