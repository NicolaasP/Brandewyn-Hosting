<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Our Menu</title>
        <link rel="stylesheet" href="../css/menu.css">
    </head>
    <body onload="setMenu()">
        <?php readfile("modules/nav.php");?>
        <main>
            <h1>Our Menu</h1>
            <div class="menu">
                <article class="mvImg">
                    <div class="text">
                        <span class="name">Steak Egg and Chips</span>
                        <span class="price">R100.00</span>
                        <br><br>
                        <span class="description">Classic Hearty breakfast/lunch dish with a modern spin</span>
                    </div>
                    <img src="../pictures/fd1.png" alt="food picture">
                </article>
                <article class="mvImg">
                    <div class="text">
                        <span class="name">Burger</span>
                        <span class="price">R70.00</span>
                        <br><br>
                        <span class="description">This is not just your average burger</span>
                    </div>
                    <img src="../pictures/fd2.png" alt="food picture">
                </article>
                <article class="mvImg">
                    <div class="text">
                        <span class="name">Pizza</span>
                        <span class="price">R120.00</span>
                        <br><br>
                        <span class="description">Round doug slathered with home-made tomato sauce and cheese covered with only the finest ingredients what more do you want</span>
                    </div>
                    <img src="../pictures/fd3.png" alt="food picture">
                </article>
            </div>
        </main>
        <footer>
            <?php readfile("modules/footer.php");?>
        </footer>
    </body>
</html>