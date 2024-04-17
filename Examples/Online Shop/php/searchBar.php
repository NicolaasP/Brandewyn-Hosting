<?php
    require_once("../logging/Log.php");

    $log = new Logger('searchBar');
    
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    $log->info("uID=" . $_SESSION["uID"]);
    if(!isset($_SESSION["uID"])){
        echo '<head>
        <meta http-equiv="refresh" content="0;url=https://brandewynhosting.co.za/Examples/Online%20Shop/php/login.php">
      </head>';
        die();
    };
?>

<link rel="stylesheet" href="../css/searchBar.css">
<link rel='icon' href="../Icons/favico.ico" type="image/x-icon">
<script src="../javascript/searchBar.js"></script>


<header>
    <div class="top">
        <button id="menuButton" type="button" class="buttons" title="Menu" onclick="menu()"></button>
        <form id="search" method="get" action="home.php">
            <input id="searchBar" class="inputs" name="sText" type="text" placeholder="Search" size="20" autocomplete="off" required="">
            <button id="searchButton" class="buttons" type="submit" title="Search">Go</button>
        </form>
        <button id="logout" type="button" class="buttons" title="Logout" onclick="location.href='login.php?man=1'"></button>
    </div>
</header>

<?php include("sideMenu.php");?>