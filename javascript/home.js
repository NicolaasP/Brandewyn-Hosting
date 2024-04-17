
function pSelect(){
    document.getElementById("rep").innerHTML = '<label class="phIn" for="phone">Phone Number: </label><br> <p id="pFailed" class="p">Please enter a valid phone number</p><div id="tri" class="hidden"></div><input type="tel" name="contact" id="phone" placeholder="+27000000000" required><br>';
}

function eSelect(){
    document.getElementById("rep").innerHTML = '<label class="emIn" for="email">Email: </label><br> <input type="email" name="contact" id="email" placeholder="example@example.com" class="extend" required><br>';
}

function checkForm(){
    gtag_report_conversion();
    var form = document.forms["details"];
    var number = form["contact"].value;
    console.log(number);
    if(document.getElementById("pSel").checked){
        if(/^((\+|[0-1])\d{1,2})\d{1,3}\d{3}\d{4}$/.test(number)){
        }
        else{
            document.getElementById("phone").setAttribute("class", "failed");
            document.getElementById("pFailed").setAttribute("class", "failedTip");
            document.getElementById("tri").setAttribute("class", "nHidden");
            return false;
        }
    }
}

function prClick(i){
    var selector = document.getElementById('pckg');
    if(i === 1){
        selector.selectedIndex = 0;
    }
    if(i === 2){
        selector.selectedIndex = 1;
    }
    if(i === 3){
        selector.selectedIndex = 2;
    }
    var element = document.getElementById('form');
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

window.visibilitychange = function() {
    if(document.getElementById("pSel").checked){
        pSelect();
    }else if(document.getElementById("eSel").checked){
        eSelect();
    }else{
        document.getElementById("pSel").checked = true;
        pSelect();
    }
}

window.addEventListener('visibilitychange', function(event) {
    document.getElementById("eSel").checked = true;
   }, false);