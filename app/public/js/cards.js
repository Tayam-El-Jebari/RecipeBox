document.querySelectorAll('.quantity-input input[type="number"]').forEach((quantityInput, index) => {
    const plusButton = document.getElementById(`plus-${index}`);
    const minusButton = document.getElementById(`minus-${index}`);

    plusButton.addEventListener('click', () => {
      quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    minusButton.addEventListener('click', () => {
      if (quantityInput.value > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
      }
    });
  });