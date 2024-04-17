// Get the modal

window.onload = function() {
    // Show the modal when the page loads
        var modal = document.getElementById("acceptCookiesModal");
        modal.style.display = "block";


    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }



    // When the user clicks the accept button, send an AJAX request to accept cookies
    document.getElementById("aCookies").onclick = function() {
        modal.style.display = "none";
        acceptCookies();
    }

    // When the user clicks the deny button, just close the modal
    document.getElementById("denyCookies").onclick = function() {
        modal.style.display = "none";
    }

    // Function to accept cookies
    function acceptCookies() {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "acceptCookies.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (this.status >= 200 && this.status < 400) {
                console.log("Cookies accepted");
            } else {
                console.log("Error accepting cookies");
            }
        };
        xhr.send("accept=true");
    }
}