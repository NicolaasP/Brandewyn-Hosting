<?php
    if(isset($_GET['ip'])){
        $ip = $_SERVER['REMOTE_ADDR'];
        file_put_contents('ip.txt', $ip);
        echo'1';
    }