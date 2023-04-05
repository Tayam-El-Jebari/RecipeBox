const params = window.location.pathname.split("/");

function setStyle(foldername, styleName) {
  var style = document.createElement('link');
  style.setAttribute("rel", "stylesheet");
  style.setAttribute("type", "text/css");
  if (styleName != "") {
    style.setAttribute("href", "/css/" + foldername + "/" + styleName + ".css");
  } else {
    style.setAttribute("href", "/css/home.css");
  }
  document.head.appendChild(style);
}
setStyle(params[1], params[1]);
if (params[2] != "") {
  setStyle(params[1], "detailPage")
}

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
    quantityInput.value = currentValue + 1;
  });
});



let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

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
  console.log(cart);
}
}
function openAddToCartModal(message, success) {
  const alert = document.getElementById("alert");
  alert.innerHTML = message;
  if(!success){
    alert.classList.remove("alert-success")
    alert.classList.add("alert-danger")
  }
  else{
    alert.classList.remove("alert-danger")
    alert.classList.add("alert-success")
  }

  const addToCartModal = document.getElementById('addToCartModal');
  const modalInstance = new bootstrap.Modal(addToCartModal, {
  });
  modalInstance.show();
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