<body>

<div class="container mt-5 mb-4">
<div class="alert alert-danger d-none" id="alert" role="alert">

</div>
    <h1 class="text-center mb-4">My Account</h1>
    <div class="row bg-yellow justify-content-md-center min-vh-85">

      <div class="col-md-5">
        <h3 class="mb-3">Personal Information</h3>
        <form id="changeInformation" class="input-group" method="POST">
          <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control w-100" id="firstName" value="<?= htmlspecialchars($account->getFirstname())?>">
          </div>
          <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control w-100" id="lastName" value="<?= htmlspecialchars($account->getLastname())?>">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control w-100" id="email"value="<?= htmlspecialchars($account->getEmail())?>">
          </div>
          <div class="mb-3">
            <label for="postalCode" class="form-label">Postal Code</label>
            <input type="text" class="form-control w-100" id="postalCode"value="<?= htmlspecialchars($account->getPostalCode())?>">
          </div>
          <div class="mb-3">
            <label for="houseNumber" class="form-label">House Number</label>
            <input type="text" class="form-control w-100" id="houseNumber" value="<?= htmlspecialchars($account->getHouseNumber())?>">
          </div>
          <button type="submit" class="btn btn-primary text-end">Save Changes</button>
        </form>
      </div>
      <div class="col-md-4">
        <h3 class="mb-3">Order History (most recent 10)</h3>
        <ul class="list-group">
          <?php foreach($ordersPaid as $order) {?>
          <li class="list-group-item">
            <div class="order-info">
              <img class="order-image" src="<?= $order->getProduct()->getImageAddress(); ?>" alt="Product Image">
              <div class="order-details">
                <p><strong>Date:</strong> <?= $order->getPaidDateTime()->format('d-m-Y'); ?></p>
                <p><strong>Product Name:</strong> <?= $order->getProduct()->getProductName(); ?></p>
                <p><strong>Quantity:</strong> <?= $order->getQuantity(); ?></p>
                <p><strong>Status:</strong> <?= $order->getStatus(); ?></p>
              </div>
            </div>
          </li>
          <?php }?>
        </ul>
        <p> please contact us on support@recipebox.com if you wish to see your older order history or click <a href="/api/getOrderHistory">here</a> to see your order history in JSON format.</p>
      </div>
    </div>
  </div>
  <script src="/js/account/overview.js"></script>