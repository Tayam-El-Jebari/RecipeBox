document.addEventListener('DOMContentLoaded', function () {
    const alertMessage = document.getElementById("alert");
    const totalElement = document.getElementById('total');
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
            if (data.status === 1 && data['products'] !== null) {
                displayCart(data['products']);
            }
            else {
                alertMessage.classList.remove('d-none');
                alertMessage.innerHTML = data.message;
            }

        })
        .catch(error => {
            alertMessage.classList.remove('d-none');
            alertMessage.innerHTML = "Something went wrong loading cart! Please try again later" + error.message;
        });


    function displayCart(products) {
        updateTotal(products);
        products.forEach(product => {
            const cartItem = document.createElement('tr');
            cartItem.classList.add('cart-item');

            const [productImage, productName, productPrice, quantity, removeButton, subtotal] = createProductElement(product);

            cartItem.appendChild(createAndAppendTd(productImage));
            cartItem.appendChild(createAndAppendTd(productName));
            cartItem.appendChild(createAndAppendTd(productPrice));
            cartItem.appendChild(createAndAppendTd(quantity));
            cartItem.appendChild(createAndAppendTd(removeButton));
            cartItem.appendChild(createAndAppendTd(subtotal));

            quantity.addEventListener('input', () => {
                quantity.value = getValidQuantity(quantity.value);
                const updatedSubtotal = (product["product"]["price"] * quantity.value).toFixed(2);
                subtotal.innerHTML = `€${updatedSubtotal}`;
                product["quantity"] = quantity.value;
                updateTotal(products);
            });

            removeButton.addEventListener('click', () => {
                const productId = removeButton.id;
                removeFromCart(productId);
                cartItem.remove();
                product["quantity"] = 0;
                updateTotal(products);
            });

            document.getElementById('cart').appendChild(cartItem);
        });
    }

    function createProductElement(product) {
        const productImage = document.createElement('img');
        productImage.src = product["product"]["imageAddress"];

        const productName = createElementWithText('p', product["product"]["productName"]);

        const productPrice = createElementWithText('p', `€${product["product"]["price"]}`);

        const quantity = document.createElement('input');
        quantity.value = product["quantity"];
        quantity.type = "number";
        quantity.min = 1;
        quantity.classList.add("form-control");

        const removeButton = createElementWithText('button', 'Remove');
        removeButton.id = product["product"]["productId"];
        console.log(removeButton.dataset)
        removeButton.classList.add("btn", "btn-danger");

        const subtotal = createElementWithText('p', `€${(product["product"]["price"] * product["quantity"]).toFixed(2)}`);

        return [productImage, productName, productPrice, quantity, removeButton, subtotal];
    }
    function createAndAppendTd(content) {
        const td = document.createElement('td');
        td.appendChild(content);
        return td;
    }
    function getValidQuantity(value) {
        const intValue = parseInt(value, 10);
        if (intValue > 0 && intValue === parseFloat(value) && intValue < 21) {
            return intValue;
        } else if (intValue > 20){
            return 20;
        } else {
            return 0;
        }
    }
    function createElementWithText(tag, text) {
        const element = document.createElement(tag);
        element.textContent = text;
        return element;
    }
    function removeFromCart(productId) {
        let cart = JSON.parse(sessionStorage.getItem('cart') || '[]');
        cart = cart.filter(item => item['id'] != (productId));
        sessionStorage.setItem('cart', JSON.stringify(cart));
        console.log(sessionStorage.getItem('cart'))
    }
    function updateTotal(products) {
        const total = calculateTotal(products);
        totalElement.innerHTML = `Total: €${total.toFixed(2)}`;
    }
    function calculateTotal(products) {
        let total = 0;
    
        products.forEach(product => {
            const price = product["product"]["price"];
            const quantity = product["quantity"];
            total += price * quantity;
        });
    
        return total;
    }
});
