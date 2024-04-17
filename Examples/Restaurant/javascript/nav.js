function setHome(){
    document.getElementById("homeB").setAttribute("class", "navB current");
    document.getElementById("aboutB").setAttribute("class", "navB");
    document.getElementById("menuB").setAttribute("class", "navB");
}

function setAbout(){
    document.getElementById("homeB").setAttribute("class", "navB");
    document.getElementById("aboutB").setAttribute("class", "navB current");
    document.getElementById("menuB").setAttribute("class", "navB");
}

function setMenu(){
    document.getElementById("homeB").setAttribute("class", "navB");
    document.getElementById("aboutB").setAttribute("class", "navB");
    document.getElementById("menuB").setAttribute("class", "navB current");
}