<?php
require_once("db.php");
require_once("../logging/Log.php");

$db = new DB();
$log = new Logger("viewCart");
session_start();

// Assuming you have a db connection in $conn
// and a db class with methods like query() and fetchAll()

// Get the user ID from the session
    if(!isset($_SESSION["uID"])){
        echo '<head>
        <meta http-equiv="refresh" content="0;url=https://brandewynhosting.co.za/Examples/Online%20Shop/php/login.php">
      </head>';
        die();
    };
$uID = $_SESSION['uID'];

// Retrieve the cart items from the database
$row = $db->getCart($uID);

// Split the cart string into an array of item IDs
$itemIDs = explode(',', $row['cart']);

// Initialize an array to hold the item counts
$itemCounts = array();

// Count the occurrences of each item ID
foreach ($itemIDs as $id) {
    if (isset($itemCounts[$id])) {
        $itemCounts[$id]++;
    } else {
        $itemCounts[$id] = 1;
    }
}

// Retrieve the item details from the database
$items = $db->getCartItems($itemCounts);

// Display the items with their counts

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/viewCart.css">
        <script src="../javascript/viewCart.js"></script>
        <link rel="icon" href="../Icons/favico.ico" type="image/x-icon">
    </head>
    <body>
        <header>
            <?php include('searchBar.php');?>
        </header>
        <main>
            <?php
                $i = 0;
                $subTotal = 0;
                $vat = 0.14;
                echo "<h2>Your Cart</h2>";
                echo "<table id='table'>";
                echo "<tr><th class='l'>Item</th><th>Count</th><th>Individual Price</th><th class='r'>Line Total</th></tr>";
                foreach ($items as $item) {
                    $linePrice = $itemCounts[$item['id']] * floatval($item['price']);
                    $subTotal += $linePrice;
                    echo "<tr>";
                    echo "<td class='data'>" . htmlspecialchars($item['title']) . "</td>";
                    echo "<td class='data'>" . htmlspecialchars($itemCounts[$item['id']]) . "</td>";
                    echo "<td class='data'>R" . htmlspecialchars(number_format($item['price'], 2, '.', '')) . "</td>";
                    echo "<td id=" . $i++ . " class='data r'>R" . htmlspecialchars(number_format($linePrice, 2, '.', '')) . "</td>";
                    echo "<td class='bCell'><button class='removeItem' title='Remove one item' onclick='remove(" . $item['id'] . ")'></button></td>";
                    echo "<td class='bCell'><button class='addItem' title='Add one item' onclick='add(" . $item['id'] . ")'></button></td>";
                    echo "</tr>";
                }
                echo "<tr>";
                echo "<td class='sub'></td>";
                echo "<td class='sub'></td>";
                echo "<td class='sub l'>Sub Total</td>";
                echo "<td class='sub r'>R" . number_format($subTotal, 2, '.', '') . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td class='sub l t'>Total</td>";
                echo "<td class='sub r t'>R" . htmlspecialchars(number_format(($subTotal+($subTotal*$vat)), 2, '.', '')) . "</td>";
                echo "</tr>";
                echo "</table>";
            ?>
            <script>var itemCount = <?php echo $i?>;</script>

            <button type='button' id='buy' class='buttons' onclick='pay()'>Buy</button>
        </main>
    </body>
</html>