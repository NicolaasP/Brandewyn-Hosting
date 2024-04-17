<?php
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $referer = $_SERVER['HTTP_REFERER'];
    $request_uri = $_SERVER['REQUEST_URI'];
    $http_method = $_SERVER['REQUEST_METHOD'];
    $ignore_ip = file_get_contents('../ip.txt');
    
    // Prepare the email content
    $to = 'webmaster@brandewynhosting.co.za';
    $subject = 'Error Page Accessed';
    $message = "User IP: $user_ip\n" .
               "User Agent: $user_agent\n" .
               "Referer: $referer\n" .
               "Request URI: $request_uri\n" .
               "HTTP Method: $http_method\n";

    if(!($user_ip === $ignore_ip)){
        mail($to, $subject, $message);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>No found</title>
    </head>
    <body>
        <h1>This in not the page you were looking for</h1>
        <h2>We could not find the page your were searching for</h2>
        <h2>We are working to solve this problem</h2>
    </body>
</html>