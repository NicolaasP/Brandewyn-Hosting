<?php
    session_start();
    require_once("db.php");
    $db = new DB();
    $uname = $db->getUname($_SESSION['uID']);
?>

<link rel="stylesheet" href="../css/sideMenu.css">

<div id="sideMenu" class="hidden">
    <div class="menu">
        <ul class="menuItems">
            <li class="mItem">
                <p class="uname"><?php echo $uname;?></p>
            </li>
            <li class="mItem">
                <a href="home.php" class="buttons">Home</a>
            </li>
            <li class="mItem">
                <a href="viewCart.php" class="buttons">View Cart</a>
            </li>

        </ul>
    </div>
</div>