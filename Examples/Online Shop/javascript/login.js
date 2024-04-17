document.addEventListener("DOMContentLoaded", function(){
    document.getElementById('pwdshow').addEventListener('click', function(event){
        var pwd = document.getElementById("pwd");
        var type = pwd.type;
        if(type == 'text'){
            pwd.type = 'password';
        }else{
            pwd.type = 'text';
        }
    });
});