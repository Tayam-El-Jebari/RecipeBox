<?php

include __DIR__ . '/../header.php';
?>
<!DOCTYPE html>
<html lang="en">
<link href="/css/account.css" rel="stylesheet">

<body class='text-center'>
    <main class="form-login">
        <form method="POST" id="signUpForm" onSubmit="return false; // Returning false stops the page from reloading">
            <h1 class="h3 mb-3 fw-normal">Registreer hier</h1>
            <div class="infoMessage"> </div>
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="firstname" id="firstname" minlength="2" required>
                <label for="floatingInput">voornaam</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="lastname" id="lastname" minlength="2" required>
                <label for="floatingInput">achternaam</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" placeholder="name@example.com" id="email" minlength="7" required>
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" placeholder="Password" id="password" minlength="8" required>
                <label for="floatingPassword">Wachtwoord</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" placeholder="Confrim Password" id="passwordConfirm" minlength="8" required>
                <label for="floatingPassword">confirm password</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="postcode" id="postalCode" minlength="6" required>
                <label for="floatingInput">Post code</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" placeholder="huis nummer" id="houseNumber" minlength="1" required>
                <label for="floatingInput">huisnummer</label>
            </div>

            <div class="mb-3">
                <label>
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" id="signUp">Sign up</button>
        </form>
    </main>


    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#signUpForm").on('submit', function(e) {
                if ($("#password").val() != $("#passwordConfirm").val()) {
                    e.preventDefault();
                    alert("Passwords do not match!");
                } else {
                    $.ajax({
                        url: 'register/createAccount',
                        type: "POST",
                        data: {
                            firstname: $("#firstname").val(),
                            lastname: $("#lastname").val(),
                            email: $("#email").val(),
                            password: $("#password").val(),
                            postalcode: $("#postalCode").val(),
                            housenumber: $("#housenumber").val(),
                        },
                        dataType: 'json',
                        processdate: false,
                        cache: false,
                        procesData: false,
                        success: function(response) {
                            $(".infoMessage").css("display", "block");

                            if (response.status === 1) {
                                $("#signUpForm")[0].reset();
                            }
                            $(".infoMessage").html('<p>' + response.message + '</p>');
                            
                        },
                    });
                }
            });
        })
    </script>
</body>

<?php

include __DIR__ . '/../footer.php';
?>