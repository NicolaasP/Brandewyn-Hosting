var pos = 0;
function nextPic(){
    pos++;
    if(pos >= paths.length)
        pos = 0;
    var img = document.getElementById("dispImg");
    img.src = paths[pos];
}

function prevPic(){
    pos--;
    if(pos < 0)
        pos = paths.length - 1;
    var img = document.getElementById("dispImg");
    img.src = paths[pos];
}

function addToCart() {
    // Prepare the data to be sent as a POST request
    const data = new URLSearchParams();
    data.append('item', id);

    // Send the POST request to addToCart.php
    fetch('addToCart.php', {
        method: 'POST',
        body: data,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text(); // or response.json() if the server returns JSON
    })
    .then(data => {
        console.log('Success:', data);
        if(data === '1'){
            alert("Added to cart");
        }else{
            alert("Failed to add to cart");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle the error here
    });
}