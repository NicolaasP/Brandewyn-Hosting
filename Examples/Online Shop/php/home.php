<?php 
session_start();
require_once("db.php");
require_once("item.php");
$db = new DB();
$s = '%';
if(isset($_GET['sText'])){
    $s = '%' . $_GET['sText'] . '%';
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Example Shop</title>
        <meta name="description" content="The cheapest prices in town!">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/home.css">
        <link rel="icon" href="../Icons/favico.ico" type="image/x-icon">
        <script src="../javascript/home.js"></script>
    </head>
    <body>
        <?php include('searchBar.php'); ?>
        <main>
            <div id='res' class='items'>
                <?php
                    $disp = "<div class=\"item\" onclick=\"location.href='viewItem.php?id=temp'\">
                    <img src=\"../itemPictures/default/default.png\" alt=\"Product Image\" class=\"itemImg\">
                    <h2 class=\"itemTitle\">ItemTitle</h2>
                    <p class=\"itemPrice\">R0.00</p>
                    </div>";
                    $items = $db->getItems($s);
                    foreach ($items as $item) {
                        echo"<div class=\"item\" onclick=\"location.href='viewItem.php?id=" . $item->id . "'\">
                        <img src=\"" . $item->defPic . "\" alt=\"Picture of " . $item->title . "\" class=\"itemImg\">
                        <h2 class=\"itemTitle\">" . $item->title . "</h2>
                        <p class=\"itemPrice\">R" . $item->price . "</p>
                        </div>";
                    }
                ?>
            </div>
            <?php
                if(!$db->checkAcceptCookies($_SESSION['uID'])){
                    echo"<div id=\"acceptCookiesModal\" class=\"modal\">
                            <div class=\"modal-content\">
                                <h2>Accept Cookies</h2>
                                <p>We only use cookies to allow us to identify you with out the need for you to login.</p>
                                <button id=\"aCookies\">Accept</button>
                                <button id=\"denyCookies\">Deny</button>
                            </div>
                        </div>";
                }
            ?>
        </main>
    </body>
</html>