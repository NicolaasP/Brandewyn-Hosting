<?php
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $referer = $_SERVER['HTTP_REFERER'];
    $request_uri = $_SERVER['REQUEST_URI'];
    $http_method = $_SERVER['REQUEST_METHOD'];
    $time = $_SERVER['REQUEST_TIME'];
    $ignore_ip = file_get_contents('ip.txt');
    
    // Prepare the email content
    $to = 'webmaster@brandewynhosting.co.za';
    $subject = 'Site Visited';
    $message = "User IP: $user_ip\n" .
               "User Agent: $user_agent\n" .
               "Referer: $referer\n" .
               "Request URI: $request_uri\n" .
               "HTTP Method: $http_method\n" .
               "Request time: $time\n";

    if(!($user_ip === $ignore_ip)){
        mail($to, $subject, $message);
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
        <meta name="description" content="Website development and hosting">
        <Title>Brandewyn Hosting</Title>
        <link rel="stylesheet" media="(orientation: landscape)" href="../css/home.css">
        <link rel="stylesheet" media="(orientation: portrait)" href="../css/homeMobile.css">
        <script type="text/javascript" src="javascript/home.js"></script>
        <link rel="icon" href="favico.ico" type="image/x-icon">
        
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4202925561269851"
     crossorigin="anonymous"></script>

        <script>
        function gtag_report_conversion(url) {
        var callback = function () {
            if (typeof(url) != 'undefined') {
            window.location = url;
            }
        };
        gtag('event', 'conversion', {
            'send_to': 'AW-11480400585/hnp4CLOA2ZEZEMmFpOIq',
            'event_callback': callback
        });
        return false;
        }
        </script>

        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11480400585"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-11480400585');
        </script>

    </head>
    <body>

    <?php include "php/head.php";
    include "php/sideMenu.php"; ?>

        <header>
            <h1>Brandewyn Hosting</h1>
            <div class='logoDiv'>
                <img src='BH_LOGO.png' alt='LOGO' class='logo'>
                <p>Nicolaas Ivan Pretorius
                <br> Phone <a href="tel:+27623911953">+27623911953</a>
                <br> Email: <a href="mailto:nicolaas@brandewynhosting.co.za">nicolaas@brandewynhosting.co.za</a></p>
            </div>
        </header>

        <main class="div">

            <div class="div">
                <h3>
                    Brandewyn Hosting is a boutique web development and hosting company, run by Nicolaas Ivan Pretorius, a dedicated and passionate web professional. With a keen eye for design and a deep understanding of the latest web technologies, Nicolaas is committed to creating visually stunning and highly functional websites that stand out in the digital landscape.
                </h3>
            </div>
            

            
            <div data-nosnippet>
                <form method=post action="submitted.php" onsubmit="return checkForm()" class="form div" name="details" id='form'>
                    <h2>Please fill out the form below and we will contact you</h2><br>

                    <label class="nameIn" for="name">Name: </label><br>
                    <input type="text" name="name" id="name" placeholder="John Doe" class="extend" required><br>

                    <label for="pckg">Please select your package</label><br>
                    <select id="pckg" name="pckg" class="options">
                        <option value="b">Basic</option>
                        <option value="i">Intermediate</option>
                        <option value="c">Custom</option>
                    </select><br>

                    <h2>How would you like to be contacted?</h2><br>

                    <div id="cDiv">
                        <div id='pDiv'>
                            <label for="pSel">Phone</label>
                            <input type="radio" name="cmethod" value="p" id="pSel" class="rButtons" onclick="pSelect()"><br class="mShow">
                        </div>
                        <div id='eDiv'>
                            <label for="eSel">Email</label>
                            <input type="radio" name="cmethod" value="e" id="eSel" class="rButtons" onclick="eSelect()" checked><br>
                        </div>
                    </div>
                    <div id="rep">
                    <label class="emIn" for="email">Email: </label><br> <input type="email" name="contact" id="email" placeholder="example@example.com" class="extend" required><br>
                    </div>


                    <textarea id="msgBox" name="msg" placeholder="Optional desctiption of the website you want"></textarea><br>

                    <button class="subB">Submit</button>
                </form>
            </div>
        </main>
        <footer>
            <p>Nicolaas Ivan Pretorius <br> Phone <a href="tel:+27623911953">+27623911953</a> <br> Email: <a href="mailto:nicolaas@brandewynhosting.co.za">nicolaas@brandewynhosting.co.za</a></p>
        </footer>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4202925561269851"
     crossorigin="anonymous"></script>
    </body>
</html>