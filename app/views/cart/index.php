<body>
<div class="alert alert-danger d-none margin-top" id="alert" role="alert"> </div>
    <div class="container mt-7 min-vh-85">
        <h1 class="mb-4">Shopping Cart</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity (max 20)</th>
                    <th scope="col">Remove</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody id="cart">

            </tbody>
        </table>
        <div class="text-end">
            <h4 id="total">Total: <span>€0,-</span></h4>
            <button class ="icon-link add-to-cart-btn" id="continueButton"disabled>CART IS EMPTY</button>
        </div>
    </div>
