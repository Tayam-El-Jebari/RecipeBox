    const lazyLoadNutritionalData = async (element) => {
      const searchQuery = element.getAttribute("data-ingredient");
      const ingredientWeight = element.getAttribute("data-ingredient-weight");
      const apiUrl = `https://world.openfoodfacts.org/cgi/search.pl?search_terms=${searchQuery}&page-count=1&search_simple=1&json=true&page_size=2`;
  
      try {
        const response = await fetch(apiUrl);
        const data = await response.json();
        const product = data.products[0];
  
        // Generate the table using the fetched data
        const table = generateNutritionalDataTable(product, ingredientWeight);
  
        // Insert the table into the element
        element.innerHTML = table;
      } catch (error) {
        console.error("Error fetching nutritional data:", error);
      }
    };
  
    const generateNutritionalDataTable = (product, ingredientWeight) => {
        const nutriments = product.nutriments;
        return `
          <div class="table-responsive mt-5">
            <h3>${product.product_name}</h3>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Nutrient</th>
                  <th scope="col">Amount per 100g</th>
                  <th scope="col">Amount for ${ingredientWeight}g</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Energy</td>
                  <td>${nutriments['energy-kcal_100g'] ?? 0} kcal</td>
                  <td>${Math.round((nutriments['energy-kcal_100g'] ?? 0) / 100 * ingredientWeight).toFixed(0)} kcal</td>
                </tr>
                <tr>
                  <td>Fat</td>
                  <td>${nutriments['fat_100g'] ?? 0} g</td>
                  <td>${Math.round((nutriments['fat_100g'] ?? 0) / 100 * ingredientWeight).toFixed(0)} g</td>
                </tr>
                <tr>
                  <td>Saturated Fat</td>
                  <td>${nutriments['saturated-fat_100g'] ?? 0} g</td>
                  <td>${Math.round((nutriments['saturated-fat_100g'] ?? 0) / 100 * ingredientWeight).toFixed(0)} g</td>
                </tr>
                <tr>
                  <td>Carbohydrates</td>
                  <td>${nutriments['carbohydrates_100g'] ?? 0} g</td>
                  <td>${Math.round((nutriments['carbohydrates_100g'] ?? 0) / 100 * ingredientWeight).toFixed(0)} g</td>
                </tr>
                <tr>
                  <td>Sugars</td>
                  <td>${nutriments['sugars_100g'] ?? 0} g</td>
                  <td>${Math.round((nutriments['sugars_100g'] ?? 0) / 100 * ingredientWeight).toFixed(0)} g</td>
                </tr>
                <tr>
                  <td>Fiber</td>
                  <td>${nutriments['fiber_100g'] ?? 0} g</td>
                  <td>${Math.round((nutriments['fiber_100g'] ?? 0) / 100 * ingredientWeight).toFixed(0)} g</td>
                </tr>
                <tr>
                  <td>Proteins</td>
                  <td>${nutriments['proteins_100g'] ?? 0} g</td>
                  <td>${Math.round((nutriments['proteins_100g'] ?? 0) / 100 * ingredientWeight).toFixed(0)} g</td>
                </tr>
                <tr>
                  <td>Salt</td>
                  <td>${nutriments['salt_100g'] ?? 0} g</td>
                  <td>${Math.round((nutriments['salt_100g'] ?? 0) / 100 * ingredientWeight).toFixed(0)} g</td>
                </tr>
              </tbody>
            </table>
          </div>
        `;
      }
  
    const elements = document.querySelectorAll(".nutritional-data");
    const config = {
      root: null,
      rootMargin: "0px",
      threshold: 0,
    };
  
    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          lazyLoadNutritionalData(entry.target);
          observer.unobserve(entry.target);
        }
      });
      document.getElementById("loading").classList.add("d-none")
    }, config);
  
    elements.forEach((element) => {
      observer.observe(element);
    });