    const alertMessage = document.getElementById("alert");
    const totalElement = document.getElementById('total');
    alertMessage.classList.remove('alert-success');
    alertMessage.classList.add('alert-danger');
    const continueButton = document.getElementById("continueButton");



    fetch('cart/getCartItems', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            cart: JSON.parse(sessionStorage.getItem('cart') || '[]'),
        })
    })  .then(response => response.json())
    .then(data => {
            if ((data.status === 1 || data.status === 2) && data['products'] !== null) {
                continueButton.innerHTML = "PLEASE LOGIN FIRST TO CONTINUE";
                updateSessionStorageCart(data['products']);
                displayCart(data['products']);
                if(data.status === 2){
                    configureContinueButton();
                }
                if(data['message'] != ''){
                    showAlertMessage(data['message']);
                }
            }
            else {
                showAlertMessage(data['message']);
            }if( data['products'] === null){
                updateSessionStorageCart([]);
            }
        })
        .catch(error => {
            showAlertMessage("It seems like loading the cart failed. We fixed the issue for you, but sadly it does mean the data in the cart is lost. We apologize for any inconvenience.");
            sessionStorage.removeItem('cart')
        });
        
    function updateSessionStorageCart(products) {
        let updatedCart = [];

        products.forEach(product => {
            updatedCart.push({
                id: product["product"]["productId"],
                quantity: product["quantity"]
            });
        });
        sessionStorage.setItem('cart', JSON.stringify(updatedCart));
    }

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
                const productId = quantity.id;
                quantity.value = getValidQuantity(quantity.value);
                const updatedSubtotal = (product["product"]["price"] * quantity.value).toFixed(2);
                subtotal.innerHTML = `€${updatedSubtotal}`;
                product["quantity"] = quantity.value;
                updateProductQuantity(productId, quantity.value);
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
        quantity.id = product["product"]["productId"];
        quantity.classList.add("form-control");

        const removeButton = createElementWithText('button', 'Remove');
        removeButton.id = product["product"]["productId"];
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
        } else if (intValue > 20) {
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
    }
    function updateProductQuantity(productId, newQuantity) {
        let cart = JSON.parse(sessionStorage.getItem('cart') || '[]');
        cart = cart.map(item => {
            if (item['id'] == productId) {
                item['quantity'] = newQuantity;
            }
            return item;
        });
        sessionStorage.setItem('cart', JSON.stringify(cart));
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

    function configureContinueButton(){
        continueButton.disabled = false;
        continueButton.innerHTML = "CONTINUE";
        continueButton.addEventListener('click', (event) => {
            processPayment();
        });
    }

    function processPayment(){
        fetch('cart/processPayment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                cart: JSON.parse(sessionStorage.getItem('cart') || '[]'),
            })
        }).then(response => response.json())
            .then(data => {
                alertMessage.classList.remove('d-none');
                if (data.status === 1) {
                    alertMessage.classList.remove('alert-danger');
                    alertMessage.classList.add('alert-success');
                    deleteAllCartItems();
                }
                showAlertMessage(data.message);
            })
            .catch(error => {
                showAlertMessage("It seems like loading the cart failed. We fixed the issue for you, but sadly it does mean the data in the cart is lost. We apologize for any inconvenience." +error.message);
                sessionStorage.removeItem('cart')
            });
    }
    function showAlertMessage(stringMessage){
        alertMessage.classList.remove('d-none');
        alertMessage.innerHTML = stringMessage;
    }
    function deleteAllCartItems(){
        const cartItems = document.querySelectorAll('.cart-item');
        cartItems.forEach(item => item.remove());
        sessionStorage.setItem('cart', JSON.stringify([]));
        updateTotal([])
    }
