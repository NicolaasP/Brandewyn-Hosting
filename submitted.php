<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Brandewyn Hosting</title>
        <link rel="stylesheet" media="(orientation: landscape)" href="../css/submitted.css">
        <link rel="stylesheet" media="(orientation: portrait)" href="../css/submittedMobile.css">
        
        <meta name="description" content="A page to thank the user for making a request">
    </head>
    <body>
        <h1>Thank you <?php echo $_POST["name"];?><br>Please allow up to 2 business days</h1>
        <?php
            $file = fopen("data/data.csv", "a+") or die("Unable to load file");
            if(str_word_count(fgets($file)) < 1){
                fwrite($file, "Name,Contact,Message\n");
            }
            fwrite($file, $_POST['name'] . "," . $_POST['contact'] . "," . $_POST['msg'] . "\n");
            fclose($file);
            
            $message = $_POST["name"] . " would like a website\nName: " . 
            $_POST["name"] . "\nPackage: " . $_POST["pckg"] . "\nContact: " . $_POST["contact"] . "\nIP: " . $_SERVER['REMOTE_ADDR'] . "\nMessage:\n" . $_POST["msg"];
            mail("nicolaas@brandewynhosting.co.za", "WEB SITE REQUEST", $message, "From: webmaster@brandewynhosting.co.za");

            $to = $_POST["contact"];
            $name = $_POST["name"];
            $subject = "Brandewyn Hosting";
            $message = "<div style='display: block; margin: auto; padding: 10px; background-color: antiquewhite; width: 80%;'>
            <img src='https://brandewynhosting.co.za/BH_LOGO.png' alt='Brandewyn Hosting' style='display: block; margin: auto; border-radius: 10px;'><br>
            <p style='text-align: center;'>
                Hi $name
                <br><br>This email serves to inform you that we have recieved you request
                for a website and will be in contact with you shortly<br><br>Sincerely<br>
                <a href='https://brandewynhosting.co.za' rel='noreferrer' target='_blank'>Brandewyn Hosting</a>
                <br><br>This is an automated unattended mailbox please do not reply<br>Please direct all enquiries to <a href='mailto:nicolaas@brandewynhosting.co.za'>nicolaas@brandewynhosting.co.za</a>;
            </p>
            <footer style='text-align: center;'>
                <p>Nicolaas Ivan Pretorius <br> Phone <a href='tel:+27623911953'>+27623911953</a> <br> Email: <a href='mailto:nicolaas@brandewynhosting.co.za'>nicolaas@brandewynhosting.co.za</a></p>
            </footer>
        </div>";
            $header = "From:noreply@brandewynhosting.co.za\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
            

            if($_POST["cmethod"] == "e"){
                mail($to, $subject, $message, $header);
            }
        ?>
    </body>
</html>
