<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $URL = "http://www.brandewynhosting.co.za/Cutoff/cutoff.php?id=";
    $indexF = "index.php";
    $upiF = "index.txt";
    $unpaid = "../cutoff/unpaid.txt";
    $URL .= file_get_contents("../cutoff/id.txt");

    $options = array(
        "http" => array(
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "GET"
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($URL, false, $context);

    if ($result === "0" && !file_exists($upiF)) {
        rename($indexF, $upiF);
        rename($unpaid, $indexF);
    }elseif($result === "1" && file_exists($upiF)) {
        rename($indexF, $unpaid);
        rename($upiF, $indexF);
    }
