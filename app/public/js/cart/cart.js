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
            displayCart(data['products']);
            console.log(data['products'])
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



    function displayCart(products) {
        products.forEach(product => {
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            
            const productImage = document.createElement('img');
            productImage.src = product["product"]["imageAddress"];
            cartItem.appendChild(productImage);

            const productName = document.createElement('h3');
            productName.textContent = product["product"]["productName"];
            cartItem.appendChild(productName);

            const productPrice = document.createElement('p');
            productPrice.textContent = `Price: €${product["product"]["price"]}`;
            cartItem.appendChild(productPrice);
            const decreaseBtn = document.createElement('button');
decreaseBtn.textContent = '-';
cartItem.appendChild(decreaseBtn);

const quantityDisplay = document.createElement('span');
quantityDisplay.textContent = product["quantity"];
cartItem.appendChild(quantityDisplay);

const increaseBtn = document.createElement('button');
increaseBtn.textContent = '+';
cartItem.appendChild(increaseBtn);
decreaseBtn.addEventListener('click', () => {
    product["quantity"]--;
    quantityDisplay.textContent = product["quantity"];
});

increaseBtn.addEventListener('click', () => {
    product["quantity"]++;
    quantityDisplay.textContent = product["quantity"];
});
document.getElementById('cart').appendChild(cartItem);
        });
        // 
        // 

        // 
        // 
        // 

        // 
        // 
        // 
        // 
        // 
        // 


        // const cartItemsContainer = document.getElementById('cart-items');
        // cartItemsContainer.innerHTML = '';

        // cart.forEach(item => {
        //     const row = document.createElement('tr');
        //     const idCell = document.createElement('td');
        //     const quantityCell = document.createElement('td');

        //     idCell.textContent = item.id;
        //     quantityCell.textContent = item.quantity;

        //     row.appendChild(idCell);
        //     row.appendChild(quantityCell);
        //     cartItemsContainer.appendChild(row);
        // });
    }

   
})



