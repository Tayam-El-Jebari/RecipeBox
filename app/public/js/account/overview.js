const alertMessage = document.getElementById("alert");

document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('#changeInformation').addEventListener('submit', function (e) {
        console.log("ohh")
        e.preventDefault();
            fetch('account/updateAccount', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    firstName: document.querySelector('#firstName').value,
                    lastName: document.querySelector('#lastName').value,
                    email: document.querySelector('#email').value,
                    postalCode: document.querySelector('#postalCode').value,
                    houseNumber: document.querySelector('#houseNumber').value,
                })
            }).then(response => response.json())
                .then(data => {
                    if (data.status === 1) {
                        alertMessage.classList.remove('alert-danger');
                        alertMessage.classList.add('alert-success');
                    }
                    alertMessage.classList.remove('d-none');
                    alertMessage.innerHTML = data.message;
                })
                .catch(error => {
                    alertMessage.classList.remove('d-none');
                    alertMessage.value = "Something went wrong! Please try again later";
                });
    });

    function checkPassword(password, confirmPassword) {
        alertMessage.classList.add('d-none');
        if (password != confirmPassword) {
            alertMessage.classList.remove('d-none');
            alertMessage.innerHTML = "Passwords do not match!";
            return false;
        }
        return true;
    }
})