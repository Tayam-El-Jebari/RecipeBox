    const searchInput = document.getElementById('search');
    const categoryFilter = document.querySelectorAll('#category-filter input[type="radio"]');
    const productCards = document.querySelectorAll('.product-card');

    searchInput.addEventListener('input', filterProducts);
    categoryFilter.forEach(radio => radio.addEventListener('change', filterProducts));
    
    function filterProducts() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = document.querySelector('#category-filter input[type="radio"]:checked').value;
        
        productCards.forEach((card) => {
            const productName = card.querySelector('.product-name').textContent.toLowerCase();
            const productCategory = card.getAttribute('data-category');

            const searchTermMatch = productName.includes(searchTerm);
            const categoryMatch = !selectedCategory || productCategory === selectedCategory;

            if (searchTermMatch && categoryMatch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
    filterProducts();
