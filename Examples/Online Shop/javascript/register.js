document.addEventListener("DOMContentLoaded", function(){

    var upass = false,
        epass = false,
        ppass = false,
        p1pass = false;

    document.getElementById('uname').addEventListener("focusout", function(){
        if(!upass){
            this.className = "err";
            document.getElementById('uname').focus()
        }
        this.reportValidity();
    });

    document.getElementById('uname').addEventListener('input', function() {
        var size = Math.max(this.value.length,  20); // Ensure the size is at least  10
        this.size = size;
        var uname = this.value;
        if(uname === ''){
            this.className = "em";
            upass = false;
            return;
        }

        else if(uname.length <= 3){
            this.className = "err";
            this.setCustomValidity("Username must be longer than 3 characters");
            setTimeout(() => {
                this.reportValidity();
            }, 1000);
            return;
        }
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'userExists.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status >=  200 && this.status <  400) {
                var response = this.responseText;
                var uname = document.getElementById('uname');
                if (response === 'exists') {
                    // Username is taken
                    uname.setCustomValidity('Username is already taken.');
                    setTimeout(() => {
                        this.reportValidity();
                    }, 1000);
                    uname.className = "err";
                    upass = false;
                } else {
                    // Username is available
                    uname.setCustomValidity('');
                    uname.reportValidity();
                    uname.className = "pass";
                    upass = true;
                }
            }
        };
        xhr.send('uname=' + encodeURIComponent(uname));
    });



    document.getElementById('email').addEventListener("focusout", function(){
        if(!epass){
            this.className = "err";
            document.getElementById('email').focus()
        }
        this.reportValidity();
    });

    document.getElementById('email').addEventListener('input', function() {
        var size = Math.max(this.value.length,  20); // Ensure the size is at least  10
        this.size = size;

        var email = this.value;
        var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if(email === ''){
            this.className = "em";
            epass = false;
            return;
        }

        else if(email.length <= 3){
            this.className = "err";
            this.setCustomValidity("Username must be longer than 3 characters");
            setTimeout(() => {
                this.reportValidity();
            }, 1000);
            return;
        }
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'userExists.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status >=  200 && this.status <  400) {
                var response = this.responseText;
                var email = document.getElementById('email');
                if (response === 'exists') {
                    // Username is taken
                    email.setCustomValidity('Email already registered');
                    setTimeout(() => {
                        this.reportValidity();
                    }, 1000);
                    email.className = "err";
                    epass = false;
                } else {
                    // Username is available
                    email.setCustomValidity('');
                    email.reportValidity();
                    email.className = "pass";
                    epass = true;
                }
            }
        };
        xhr.send('email=' + encodeURIComponent(email));
    });



    document.getElementById('pwd').addEventListener("focusout", function(){
        if(!ppass){
            this.className = "err";
            document.getElementById('pwd').focus()
        }
        this.reportValidity();
    });

    document.getElementById('pwd').addEventListener('input', function(){
        var size = Math.max(this.value.length,  20); // Ensure the size is at least  10
        this.size = size;
        var pwd = this.value;
        if(pwd.length == 0){
            this.className = "em"
            ppass = false;
        }

        else if (pwd.length <  8) {
            this.setCustomValidity("Password must be longer than 8 characters");
            this.className = "err";
            ppass = false;
        }

        else if(pwd.length >  50){
            this.setCustomValidity("Password must be shorter than 50 characters");
            this.className = "err";
            ppass = false;
        }

        // Check for uppercase letter
        else if (!/[A-Z]/.test(pwd)) {
            this.setCustomValidity("Password must contain at least 1 UPPERCASE letter");
            this.className = "err";
            ppass = false;
        }

        // Check for lowercase letter
        else if (!/[a-z]/.test(pwd)) {
            this.setCustomValidity("Password must contain at least 1 lowercase letter");
            this.className = "err";
            ppass = false;
        }

        // Check for number
        else if (!/[0-9]/.test(pwd)) {
            this.setCustomValidity("Password must contain at least 1 numb3r");
            this.className = "err";
            ppass = false;
        }

        // Check for symbol
        else if (!(/[\!\@\#\$\%\^\&\*\(\)\_\+\-\=\{\}\[\]\|\:\;\"\'\<\>\,\.\?\\\/]/.test(pwd))) {
            this.setCustomValidity("Password must contain at least 1 $ymbol");
            this.className = "err";
            ppass = false;
        }

        // If all checks pass, return true
        else{
            this.className = "pass"
            this.setCustomValidity("");
            ppass = true;
        }
        setTimeout(() => {
            this.reportValidity();
        }, 1000);
    });



    document.getElementById('pwd1').addEventListener("focusout", function(){
        if(!p1pass){
            this.className = "err";
            document.getElementById('pwd1').focus()
        }
        this.reportValidity();
    });

    document.getElementById('pwd1').addEventListener('input', function(){
        var size = Math.max(this.value.length,  20); // Ensure the size is at least  10
        this.size = size;
        var pwd1 = this.value;
        var pwd = document.getElementById("pwd").value;
        if(pwd1 === ''){
            this.className = "em";
            p1pass = false;
        }
        
        else if(pwd !== pwd1){
            this.setCustomValidity("Passwords do not match");
            setTimeout(() => {
                this.reportValidity();
            }, 1000);
            this.className = "err";
            p1pass = false;
        }

        else{
            this.setCustomValidity("");
            this.reportValidity();
            this.className = "pass";
            p1pass = true;
        }
    });

    document.getElementById('reg').addEventListener('submit', function(event) {
        if (!(upass && epass && ppass && p1pass)) {
            event.preventDefault(); // Prevent form submission
            alert('Please correct the errors before submitting.'); // Optional: Show an alert to inform the user
        }
    });

    function show($pwd){
        var $type = $pwd.type;
        if($type == 'text'){
            $pwd.type = 'password';
        }else{
            $pwd.type = 'text';
        }
    }

    document.getElementById('pwdshow').addEventListener('click', function(event){
        show(document.getElementById('pwd'));
    });

    document.getElementById('pwd1show').addEventListener('click', function(event){
        show(document.getElementById('pwd1'));
    });
});

