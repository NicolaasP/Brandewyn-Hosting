<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>About Us</title>
        <link rel="stylesheet" href="../css/about.css">
    </head>
    <body onload="setAbout()">
        <?php readfile("modules/nav.php");?>
        <main>
            <h1>About</h1>
            <div class="about">
                <p>We are a family owned restaurant that was established in 2019</p>
            </div>

            <h2>Meet the staff</h2>

            <div class="mvImg">
                <span>Employee 1 is the owner of the restaurant</span>
                <img src="../pictures/em1.png" alt="Employee 1">
            </div>
            <div class="mvImg">
                <span>Employee 2 is our head chef and has been with us since the begining</span>
                <img src="../pictures/em2.png" alt="Employee 2">
            </div>
            <div class="mvImg">
                <span>Employee 3 is our head waiter who started as our janitor in 2020</span>
                <img src="../pictures/em3.png" alt="Employee 3">
            </div>
            <div class="mvImg">
                <span>Employee 4 is our most experianced waiter</span>
                <img src="../pictures/em4.png" alt="Employee 4">
            </div>
            <div class="mvImg">
                <span>Employee 5 our manager she has been managing restaurants since 2004 before joining us in 2022</span>
                <img src="../pictures/em5.png" alt="Employee 5">
            </div>
            <div class="mvImg">
                <span>Any respectable restaurant would be lost with out the valiant cleaning staff<br><br>
                Mr Employee 6 has been ensuring sanirary conditions since just after our doors opened</span>
                <img src="../pictures/em6.png" alt="Employee 6">
            </div>
        </main>
        <footer>
            <?php readfile("modules/footer.php");?>
        </footer>
    </body>
</html>