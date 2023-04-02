<?php

include __DIR__ . '/../header.php';
?>
<!DOCTYPE html>
<html lang="en">
<link href="/css/account.css" rel="stylesheet">

<body class='text-center'>
    <main class="form-login">
        <form method="POST" id="signUpForm" onSubmit="return false;">
            <div class="alert alert-danger d-none" id="alert" role="alert">

            </div>
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


    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('#signUpForm').addEventListener('submit', function(e) {
                if (document.getElementById("password").value != document.getElementById("passwordConfirm").value) {
                    e.preventDefault();
                    document.getElementById("alert").classList.remove('d-none')
                    document.getElementById("alert").innerHTML = "Passwords do not match!";
                } else {
                    fetch('register/createAccount', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                firstname: document.querySelector('#firstname').value,
                                lastname: document.querySelector('#lastname').value,
                                email: document.querySelector('#email').value,
                                password: document.querySelector('#password').value,
                                postalcode: document.querySelector('#postalCode').value,
                                housenumber: document.querySelector('#houseNumber').value,
                            })

                        }).then(response => response.json())
                        .then(data => {
                            document.querySelector('.infoMessage').style.display = 'block';

                            if (data.status === 1) {
                                document.querySelector('#signUpForm').reset();
                            }
                            document.querySelector('.infoMessage').innerHTML = '<p>' + data.message + '</p>';
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });




                    // $.ajax({
                    //     url: 'register/createAccount',
                    //     type: "POST",
                    //     data: {
                    //         firstname: $("#firstname").val(),
                    //         lastname: $("#lastname").val(),
                    //         email: $("#email").val(),
                    //         password: $("#password").val(),
                    //         postalcode: $("#postalCode").val(),
                    //         housenumber: $("#housenumber").val(),
                    //     },
                    //     dataType: 'json',
                    //     processdate: false,
                    //     cache: false,
                    //     procesData: false,
                    //     success: function(response) {
                    //         $(".infoMessage").css("display", "block");

                    //         if (response.status === 1) {
                    //             $("#signUpForm")[0].reset();
                    //         }
                    //         $(".infoMessage").html('<p>' + response.message + '</p>');

                    //     },

                    // });
                }
            });
        })
    </script>
    <!-- <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var signUpForm = document.getElementById('signUpForm');
        signUpForm.addEventListener('submit', function(e) {
            var password = document.getElementById('password');
            var passwordConfirm = document.getElementById('passwordConfirm');
            var alert = document.getElementById('alert');

            if (password.value !== passwordConfirm.value) {
                e.preventDefault();
                alert.classList.remove('d-none');
                alert.innerHTML = 'Passwords do not match!';
            } else {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var response = JSON.parse(this.responseText);
                        var infoMessage = document.querySelector('.infoMessage');
                        infoMessage.style.display = 'block';

                         if (response.status === 1) {
                             signUpForm.reset();
                         }
                        infoMessage.innerHTML = '<p>' + response.message + '</p>';
                    }
                };
                xhttp.open('POST', 'register/createAccount', true);
                //xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send(
                    'firstname=' + encodeURIComponent(document.getElementById('firstname').value) +
                    '&lastname=' + encodeURIComponent(document.getElementById('lastname').value) +
                    '&email=' + encodeURIComponent(document.getElementById('email').value) +
                    '&password=' + encodeURIComponent(document.getElementById('password').value) +
                    '&postalcode=' + encodeURIComponent(document.getElementById('postalCode').value)
                );
            }
        });
    });
</script> -->
</body>