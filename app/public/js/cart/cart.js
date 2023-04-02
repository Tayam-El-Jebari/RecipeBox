document.addEventListener('DOMContentLoaded', function () {
    const alertMessage = document.getElementById("alert");
    alertMessage.classList.remove('alert-success');
    alertMessage.classList.add('alert-danger');

    fetch('products/getCartItems', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        cart: JSON.parse(sessionStorage.getItem('cart') || '[]'),
    })
}).then(response => response.json())
    .then(data => {
        if (data.status === 1) {
            console.log(data)
        }
        else{
            alertMessage.classList.remove('d-none');
            alertMessage.innerHTML = data.message;
        }

    })
    .catch(error => {
        alertMessage.classList.remove('d-none');
        alertMessage.innerHTML = "Something went wrong loading cart! Please try again later" + error.message;
    });

})
