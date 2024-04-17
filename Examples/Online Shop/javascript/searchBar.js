function menu(){
    var menu = document.getElementById('sideMenu');
    if(menu.className === 'hidden'){
        menu.className = "show";
    }else{
        menu.className = "hidden";
    }
}