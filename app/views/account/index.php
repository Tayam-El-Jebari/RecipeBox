<?php

include __DIR__ . '/../header.php';
if(isset($_POST['signup'])){
    
}
?>
<!DOCTYPE html>
<html lang="en">
<link href="/css/account.css" rel="stylesheet">

<body class = 'text-center'>
<main class="form-login">
<form method="POST">
    <h1 class="h3 mb-3 fw-normal">Please log in</h1>
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Sign in</button>
  </form>
</main>


<script
  src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
  crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $("#signUp").on('click',function() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            var email = $("#email").val();
            var password = $("#password").val();
            if(firstname == "" || lastname =="" || password == "")
            {
                alert("Please check if all fields are filled in!")
            }
            else{
                $.ajax(
                {
                    url: 'login',
                    method:"POST",
                    data: {
                        signup:1,
                        firstname: firstname,
                        lastname: lastname,
                        email: email,
                        password: password,
                    },
                    success: function(response){
                        console.log(response);
                    },
                    dataType: 'Text',
                }
            );
            }
        });
    })
    </script>
</body>

<?php
include __DIR__ . '/../footer.php';
?>