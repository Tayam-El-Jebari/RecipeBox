<body>
    <div class="container min-vh-85">
        <div class="alert alert-danger d-none margin-top" id="alert" role="alert">

        </div>
        <h1 class="mt-3">Your Cart</h1>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                <!-- Items will be added dynamically by JavaScript -->
            </tbody>
        </table>
    </div>
    <script>
        // Your previous JavaScript code
        cart = JSON.parse(sessionStorage.getItem('cart')) || [];

        function displayCart() {
            const cartItemsContainer = document.getElementById('cart-items');
            cartItemsContainer.innerHTML = '';

            cart.forEach(item => {
                const row = document.createElement('tr');
                const idCell = document.createElement('td');
                const quantityCell = document.createElement('td');

                idCell.textContent = item.id;
                quantityCell.textContent = item.quantity;

                row.appendChild(idCell);
                row.appendChild(quantityCell);
                cartItemsContainer.appendChild(row);
            });
        }

        displayCart();
    </script>
    <script src="/js/cart/cart.js"></script>