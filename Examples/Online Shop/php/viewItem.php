<?php
    if(!isset($_GET['id'])){
        echo '<head>
        <meta http-equiv="refresh" content="0;url=https://brandewynhosting.co.za/Examples/Online%20Shop/php/home.php">
      </head>';
        die();
    }

    
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    require_once("db.php");
    require_once("../logging/Log.php");
    require_once("item.php");

    $log = new Logger("viewItem.php");

    $log->info("1");

    $db = new DB();

    $log->info("2");
    
    $uID = $_SESSION["uID"];

    $log->info("3");
    
    $id = $_GET["id"];

    $log->info("4");
    
    $item = $db->getItem($id);
    $db->addView($id);

    $log->info("5");
    

    

    if(!($item instanceof Item)){
        $log->error("failed to get item: $id");
        echo '<head>
        <meta http-equiv="refresh" content="0;url=https://brandewynhosting.co.za/Examples/Online%20Shop/php/home.php">
      </head>';
        die();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/viewItem.css">
        <link rel="icon" href="../Icons/favico.ico" type="image/x-icon">
        <script>
            var paths = [<?php  
                $first = true;
                foreach($item->pics as $pic){
                    if($first){
                        $first = false;
                    }else{
                        echo",";
                    }
                    echo"'" . $item->path . "$pic'";
                }?>];
            var id = <?php echo$_GET["id"]; ?>;
        </script>
        <script src="../javascript/viewItem.js"></script>
    </head>
    <body>
        <?php include("searchBar.php"); ?>
        <main>
            <div class="disp">
                <?php echo"<div class=\"item\">
                        <div class=\"imgs\">
                            <button id=\"prevB\" class=\"buttons\" onclick=\"prevPic()\">⇦</button>
                            <img id=\"dispImg\" src=\"" . $item->defPic . "\" alt=\"" . $item->title . " image\" class=\"itemImg\">
                            <button id=\"nextB\" class=\"buttons\" onclick=\"nextPic()\">⇨</button>
                        </div>
                        <h2 class=\"itemTitle\">" . $item->title . "</h2>
                        <p class=\"itemPrice\">R" . $item->price . "</p>
                        <h3 class=\"itemDesc\">" . $item->description . "</h3>
                    </div>
                    
                    <div class=\"pButtons\">
                        <button id=\"pButton\" class=\"buttons\">Buy</button>
                        <button id=\"cButton\" class=\"buttons\" onclick=\"addToCart()\"> Add to cart</button>
                    </div>";
                ?>
            </div>
        </main>
    </body>
</html>