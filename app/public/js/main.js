const params = window.location.pathname.split("/");
const alert = document.getElementById("alertModal");

document.querySelectorAll('.quantity-box').forEach(quantityBox => {
  const minusBtn = quantityBox.querySelector('#minus');
  const plusBtn = quantityBox.querySelector('#plus');
  const quantityInput = quantityBox.querySelector('#quantity');

  minusBtn.addEventListener('click', () => {
    let currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
      quantityInput.value = currentValue - 1;
    }
  });

  plusBtn.addEventListener('click', () => {
    let currentValue = parseInt(quantityInput.value);
    if(currentValue < 20) 
    quantityInput.value = currentValue + 1;
  });
});


try{
  var cart = JSON.parse(sessionStorage.getItem('cart')) || [];
}catch{
  openAddToCartModal("It seems like loading the cart failed. We fixed the issue for you, but sadly it does mean the data in the cart is lost. We apologize for any inconvenience.", false)
  var cart = []
}


function addToCart(productId, quantity, productName) {
  quantity = Math.max(quantity, 1);

  const existingProduct = cart.find(item => item.id === productId);

  if (isNaN(quantity) || quantity <= 0) {
    openAddToCartModal("something went wrong while adding to cart. Please check if quantity is correct.", false)
  } 
  else {
    if(quantity > 20){
      quantity = 20;
    }
    if (existingProduct) {
      existingProduct.quantity += quantity;
    } else {
      cart.push({
        id: productId,
        quantity: quantity
      });
    }
  
  openAddToCartModal(productName + " has been sucessfully added to cart " + encodeHTML(quantity) +" time(s)", true)
  sessionStorage.setItem('cart', JSON.stringify(cart));
}
}
function openAddToCartModal(message, success) {
  alert.innerHTML = message;
  if(!success){
    alert.classList.remove("alert-success")
    alert.classList.add("alert-danger")
  }
  else{
    alert.classList.remove("alert-danger")
    alert.classList.add("alert-success")
  }

  const addToCartModal = new bootstrap.Modal(document.getElementById('addToCartModal'));
  addToCartModal.show();

}

document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    const productId = parseInt(this.getAttribute('data-product-id'));
    const quantityInput = this.closest('.card').querySelector('#quantity');
    const quantity = parseInt(quantityInput.value);

    addToCart(productId, quantity, this.getAttribute('data-product-name'));
  });
});

function encodeHTML(s) {
  s = String(s);
  // replace &, <, and " with corresponding HTML entities (&amp;, &lt;, and &quot;).
  return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/"/g, '&quot;');
}