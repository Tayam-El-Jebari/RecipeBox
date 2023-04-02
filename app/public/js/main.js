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

function addToCart(productId, quantity) {
  quantity = Math.max(quantity, 1);

  const existingProduct = cart.find(item => item.id === productId);
  if (isNaN(quantity) || quantity <= 0) {

  }else{
    if (existingProduct) {
      existingProduct.quantity += quantity;
    } else {
      cart.push({
        id: productId,
        quantity: quantity
      });
    }
  }
  openAddToCartModal("wow!!")
  sessionStorage.setItem('cart', JSON.stringify(cart));
  console.log(cart);
}
function openAddToCartModal(message) {
  var alert = document.getElementById("alert");
  alert.innerHTML=message;

  const addToCartModal = document.getElementById('addToCartModal');
const modalInstance = new bootstrap.Modal(addToCartModal, {
  // You can add optional modal options here
});
modalInstance.show();
}

document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    const productId = parseInt(this.getAttribute('data-product-id'));
    const quantityInput = this.closest('.card').querySelector('#quantity');
    const quantity = parseInt(quantityInput.value);

    addToCart(productId, quantity);
  });
});