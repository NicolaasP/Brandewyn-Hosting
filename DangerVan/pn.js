var disp = false;
var prea = new Audio("scary2.mp3");
var hit = new Audio("scary1.mp3");
var amb = new Audio("scary.mp3");
amb.loop = true;
amb.volume = 1.0;
prea.volume = 1.0;
hit.volume = 1.0;

function jump(){
    if(disp){
        return;
    }
    var jump = Math.floor(Math.random() * 10) + 5;
    setTimeout(() => pre(), (jump*1000));
}

function pre(){
    prea.play();
    setTimeout(() => scare(), (6000));
}

function scare(){
    var pop = document.getElementById("scarer");
    var body = document.getElementById("body");
    pop.className = "pop";
    body.className = "p";
    hit.play();
    disp = true;
}

function click(){
    disp = false;
    var pop = document.getElementById("scarer");
    var body = document.getElementById("body");
    pop.className = "hide";
    body.className = "n";
    updateDaysLeft();
    jump();
}

function start(){
    amb.play();
    var boo = document.getElementById("boo");
    var but = document.getElementById("but");
    boo.className = "f";
    but.className = "hide";
    jump();
}

function updateDaysLeft() {
    var today = new Date();
    var targetDate = new Date(today.getFullYear(),  2,  28); // March is  2nd month in JavaScript Date object

    var timeDiff = targetDate.getTime() - today.getTime(); // Time difference in milliseconds
    var daysLeft = Math.ceil(timeDiff / (1000 *  60 *  60 *  24)); // Convert to days

    var p = document.getElementById("msg");
    p.textContent = "See you in: " + daysLeft + " days";
    p.className = "f";
}

document.addEventListener('click', function() {
    click();
});