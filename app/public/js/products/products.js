document.getElementById('search-form').addEventListener('submit', async (event) => {
    event.preventDefault();
  
    const query = document.getElementById('search-query').value;
    const apiUrl = `https://world.openfoodfacts.org/cgi/search.pl?search_terms=${encodeURIComponent(query)}&page-count=1&search_simple=1&json=true&page_size=1`;
  
    try {
      const response = await fetch(apiUrl);
      const data = await response.json();
      if (data.products.length > 0) {
        displayNutritionalData(data.products[0]);
      } else {
        alert('No products found. Please try another search query.');
      }
    } catch (error) {
      console.error('Error fetching data:', error);
      alert('An error occurred while fetching data. Please try again later.');
    }
  });
  
  function displayNutritionalData(product) {
    document.getElementById('product-name').textContent = product.product_name;
    const nutrients = [
      ['Energy', product.nutriments.energy_kcal],
      ['Fat', product.nutriments.fat],
      ['Saturated Fat', product.nutriments['saturated-fat']]
    ];
  
    const nutrientData = document.getElementById('nutrient-data');
    nutrientData.innerHTML = '';
  
    for (const [nutrient, amount] of nutrients) {
      nutrientData.insertAdjacentHTML('beforeend', `<tr><td>${nutrient}</td><td>${amount} g</td></tr>`);
    }
  
    document.getElementById('table-container').style.display = 'block';
  }