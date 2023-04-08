<body>

<div class="min-vh-85 justify-content-center d-flex">
  <div id="form-box">
  <div class="alert alert-danger d-none" id="alert" role="alert">
</div>
    <div class="button-box">
      <div id="btn"></div>
      <button type="button" class="sign-up btn-account" id="loginbtn" onclick="login()">Log in</button>
      <button type="button" class="sign-up btn-account" id="registerbtn" onclick="register()" style="color:#333;">Sign in</button>
    </div>
    <form id="login" class="form-group input-group" method="POST">
      <div class="form-floating">
        <input type="email" class="form-control input-field" placeholder="name@example.com" id="emailLogin" minlength="7" required>
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control input-field" placeholder="name@example.com" id="passwordLogin" minlength="7" required>
        <label for="floatingInput">password</label>
      </div>
      <button type="submit" class="submit-btn btn-account">Log in</button>
    </form>

    <form id="register" class="input-group" method="POST">
      <div class="form-floating">
        <input type="email" class="form-control input-field" placeholder="name@example.com" id="emailRegister" minlength="7" required>
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control input-field" placeholder="Pieter" id="firstName" minlength="3" required>
        <label for="floatingInput">Fist Name</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control input-field" placeholder="Van Der Berg" id="lastName" minlength="3" required>
        <label for="floatingInput">Last Name</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control input-field" placeholder="2033RC" id="postalCode" minlength="3" required>
        <label for="floatingInput">Postal Code</label>
      </div>
      <div class="form-floating">
        <input type="text" class="form-control input-field" placeholder="9a" id="houseNumber" minlength="1" required>
        <label for="floatingInput">houseNumber</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control input-field" placeholder="" id="passwordRegister" minlength="7" required>
        <label for="floatingInput">Password</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control input-field" placeholder="" id="passwordConfirm" minlength="7" required>
        <label for="floatingInput">Confirm Password</label>
      </div>
      <button type="submit" class="submit-btn btn-account" id="signUp">Register</button>
    </form>
  </div>
  </div>
