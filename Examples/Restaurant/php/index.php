<?php
    include("../cutoff/cutoffTest.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Example resturant</title>
        <link rel="stylesheet" href="/Examples/Restaurant/css/index.css">
    </head>
    <body onload="setHome()">
        <?php readfile("modules/nav.php");?>
        <main>
            <h1>Example Restaurant</h1>
            <div class="mvImg">
                <span>Our modern dinning area where you can relax and enjoy our wide range of modern cuisine</span>
                <img src="../pictures/da1.png" alt="Dinning area">
            </div>
            <div class="mvImg">
                <span>Enjoy the fresh air of our outdoor seating area</span>
                <img src="../pictures/od1.png" alt="Outdoor area">
            </div>
        </main>
        <footer>
            <?php readfile("modules/footer.php");?>
        </footer>
    </body>
</html>