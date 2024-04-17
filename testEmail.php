<?php
    echo'1';
    $to = 'ivanpretorius0@gmail.com';
    $subject = "Brandewyn Hosting";
    $message = "<div style='display: block; margin: auto; padding: 10px; background-color: antiquewhite; width: 80%;'>
    <img src='https://brandewynhosting.co.za/BH_LOGO.png' alt='Brandewyn Hosting' style='display: block; margin: auto; border-radius: 10px;'><br>
    <p style='text-align: center;'>
        Hi
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

    mail($to, $subject, $message, $header);
    echo'2';