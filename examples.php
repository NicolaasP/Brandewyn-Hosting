<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
            Examples
        </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" media="(orientation: landscape)" href="../css/examples.css">
        <link rel="stylesheet" media="(orientation: portrait)" href="../css/homeMobile.css">
        <link rel="icon" href="favico.ico" type="image/x-icon">
    </head>
    <body>
        <?php 
            include "php/head.php";
            include "php/sideMenu.php";
        ?>

        <h1>
            Examples of websites that I have created
        </h1>

        <div class="div example" data-nosnippet>

                <?php
                    $root = "Examples/";
                    foreach(scandir($root) as $folder) {
                        $pckg = file_get_contents("$root$folder/pckg.txt");
                        if($folder == "." || $folder == "" || $folder == "..") continue;
                        echo'<div class="ex"><a href="Examples/' . $folder . '/php/index.php"
                        rel="noreferrer" target="_blank">' . $folder . ' - "' . $pckg . '"</a></div>';
                    }

                ?>
            </div>
            
            <div class="div prices" data-nosnippet>
                <div class="div pr basic" onclick="prClick(1)">
                    <h2>Basic</h2>
                    <h3>R1000</h3>
                    <ul>
                        <li>1 to 5 pages</li>
                        <li>Basic functionality</li>
                    </ul>
                    <p>Perfect if all you want is a website that looks good and gives an overview of your business<br></p>
                    <p>Similar to the "restaurant" example website</p>
                    
                </div>
                <div class="div pr intermediate" onclick="prClick(2)">
                    <h2>Intermediate</h2>
                    <h3>R2500</h3>
                    <ul>
                        <li>6 to 15 pages</li>
                        <li>A little more dynamic</li>
                    </ul>
                    <p>This option offers a little more. With this option you also get access to a database and some backend processing<br>
                    includes features like user accounts, saving of user's data and more</p>
                </div>
                <div class="div pr custom" onclick="prClick(3)">
                    <h2>Custom</h2>
                    <h3>Price dependent on your needs</h3>
                    <ul>
                        <li>unlimited pages</li>
                        <li>Full functionality</li>
                    </ul>
                    <p>We can work out a price depending on your specific needs</p>
                </div>
            </div>
    </body>
</html>