<body>
<div class="alert alert-danger d-none" id="alert" role="alert">

</div>

<div class="container mt-5 min-vh-85 max-vw-85">
    <h1 class="text-center mb-4">My Account</h1>
    <div class="row bg-yellow justify-content-md-center">
      <div class="col-md-4">
        <h3 class="mb-3">Personal Information</h3>
        <form id="changeInformation" class="input-group" method="POST">
          <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstName" value="<?= $account->getFirstname()?>">
          </div>
          <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" value="<?= $account->getLastname()?>">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email"value="<?= $account->getEmail()?>">
          </div>
          <div class="mb-3">
            <label for="postalCode" class="form-label">Postal Code</label>
            <input type="text" class="form-control" id="postalCode"value="<?= $account->getPostalCode()?>">
          </div>
          <div class="mb-3">
            <label for="houseNumber" class="form-label">House Number</label>
            <input type="text" class="form-control" id="houseNumber" value="<?= $account->getHouseNumber()?>">
          </div>
          <button type="submit" class="btn btn-primary text-end">Save Changes</button>
        </form>
      </div>
      <div class="col-md-4">
        <h3 class="mb-3">Order History</h3>
        <ul class="list-group">
          <li class="list-group-item">Order #1</li>
          <li class="list-group-item">Order #2</li>
          <li class="list-group-item">Order #3</li>
        </ul>
      </div>
    </div>
  </div>