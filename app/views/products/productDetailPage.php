<body>
  <div class="container mh-vh-100 pt-3">
    <div class="row bg-light-yellow rounded product d-flex align-items-center justify-content-center">
      <div class="col-sm-6">
        <img class="card-img product-detail-image img-fluid" src=" <?= $product->getImageAddress() ?> " alt="'<?= $product->getProductName() ?> '-image">
      </div>
      <div class="col-sm-6">
        <h2><?= $product->getProductName() ?></h2>
        <h3>Kcal: <?= $product->getKcal() ?></h3>
        <div class="container mt-5">
          <p class="green-text attention-text">
            <i class="fas fa-truck"></i> Order before 11:59 PM and get it tomorrow!
          </p>
          <p class="green-text attention-text">
            <i class="fas fa-star"></i> Avg. customer rating 9 with +2,000 reviews
          </p>
        </div>
      </div>
    </div>
    <h2> Allergens: </h2>
    <p>
      <?php foreach ($product->getAllergens() as $allergen){ ?>
          <?= $allergen ?>,
        <?php } ?>
    </p>
    <h2> ingredients: </h2>
    <?php
  $ingredients = $product->getIngredients();
  $ingredientsCount = count($ingredients);
  for ($i = 0; $i < $ingredientsCount; $i++) {  
    $ingredient = $ingredients[$i];
    ?>
    <?= $ingredient->getIngredient() . ' ' . $ingredient->getIngredientWeight()?>g
    <?php if ($i !== $ingredientsCount - 1) { ?>;
    <?php } } ?>

    <h2 class="mt-5"> Nutritional facts: </h2>
    <div class="container">
      <?php foreach ($product->getIngredients() as $ingredient) { ?>
        <?php
        $searchQuery = urlencode($ingredient->getIngredient());
        //for some reason the api loads 24 products with a page size of 1, and 2 products with a page size of 2, hence, for efficiency; page_size=2
        $apiUrl = "https://world.openfoodfacts.org/cgi/search.pl?search_terms={$searchQuery}&page-count=1&search_simple=1&json=true&page_size=2";

        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);
        $product = $data['products'][0];
        ?>
        <div class="table-responsive mt-5">
          <h3><?= htmlspecialchars($ingredient->getIngredient()); ?></h3>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Nutrient</th>
                <th scope="col">Amount per 100g</th>
                <th scope="col">Amount for <?= $ingredient->getIngredientWeight() ?>g</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Energy</td>
                <td><?= htmlspecialchars($product['nutriments']['energy-kcal_100g'] ?? 0) //default value assigned here in order to prevent errors?> kcal</td>
                <td><?= htmlspecialchars(($product['nutriments']['energy-kcal_100g'] ?? 0) / 100 * $ingredient->getIngredientWeight()) ?> kcal</td>
              </tr>
              <tr>
                <td>Fat</td>
                <td><?= htmlspecialchars($product['nutriments']['fat_100g'] ?? 0) ?> g</td>
                <td><?= htmlspecialchars(($product['nutriments']['fat_100g'] ?? 0) / 100 * $ingredient->getIngredientWeight()) ?> g</td>
              </tr>
              <tr>
                <td>Saturated Fat</td>
                <td><?= htmlspecialchars($product['nutriments']['saturated-fat_100g'] ?? 0) ?> g</td>
                <td><?= htmlspecialchars(($product['nutriments']['saturated-fat_100g'] ?? 0) / 100 * $ingredient->getIngredientWeight()) ?> g</td>
              </tr>
              <tr>
                <td>Carbohydrates</td>
                <td><?= htmlspecialchars($product['nutriments']['carbohydrates_100g'] ?? 0) ?> g</td>
                <td><?= htmlspecialchars(($product['nutriments']['carbohydrates_100g'] ?? 0) / 100 * $ingredient->getIngredientWeight()) ?> g</td>
              </tr>
              <tr>
                <td>Sugars</td>
                <td><?= htmlspecialchars($product['nutriments']['sugars_100g'] ?? 0) ?> g</td>
                <td><?= htmlspecialchars(($product['nutriments']['sugars_100g']  ?? 0)/ 100 * $ingredient->getIngredientWeight()) ?> g</td>
              </tr>
              <tr>
                <td>Fiber</td>
                <td><?= htmlspecialchars($product['nutriments']['fiber_100g'] ?? 0) ?> g</td>
                <td><?= htmlspecialchars(($product['nutriments']['fiber_100g'] ?? 0) / 100 * $ingredient->getIngredientWeight()) ?> g</td>
              </tr>
              <tr>
                <td>Proteins</td>
                <td><?= htmlspecialchars($product['nutriments']['proteins_100g'] ?? 0) ?> g</td>
                <td><?= htmlspecialchars(($product['nutriments']['proteins_100g']  ?? 0) / 100 * $ingredient->getIngredientWeight()) ?> g</td>
              </tr>
              <tr>
                <td>Salt</td>
                <td><?= htmlspecialchars($product['nutriments']['salt_100g'] ?? 0) ?> g</td>
                <td><?= htmlspecialchars(($product['nutriments']['salt_100g'] ?? 0) / 100 * $ingredient->getIngredientWeight()) ?> g</td>
              </tr>
            </tbody>
          </table>
        </div>
      <?php }; ?>
    </div>
  </div>