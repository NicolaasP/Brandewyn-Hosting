function remove(id){
    console.log(id);
    // Prepare the data to be sent as a POST request
    const data = new URLSearchParams();
    data.append('id', id);

    // Send the POST request to addToCart.php
    fetch('editCart.php', {
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
            console.log("Removed from cart");
            location.reload();
        }else{
            console.log("Failed to remove from cart");
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        location.reload();
        // Handle the error here
    });
}

function add(id){
    console.log(id);
    // Prepare the data to be sent as a POST request
    const data = new URLSearchParams();
    data.append('id', id);
    data.append('add', 1);

    // Send the POST request to addToCart.php
    fetch('editCart.php', {
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
            console.log("Added to cart");
            location.reload();
        }else{
            console.log("Failed to add to cart");
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        location.reload();
        // Handle the error here
    });
}

function pay(){
    alert("Payment to implamented yet");
}