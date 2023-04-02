<body>
  <div class="container vh-100 pt-3">
    <div class="row ">
      <div class="col-sm-6">
        <img class="card-img product-detail-image" src=" <?= $product->getImageAddress() ?> " alt="'<?= $product->getProductName() ?> '-image">
      </div>
      <div class="col-sm-6">
        <h2><?= $product->getProductName() ?></h2>
        <h3>Kcal: <?= $product->getKcal() ?></h3>
        <div class="container mt-5">
          <p class="green-text">
            <i class="fas fa-truck"></i> Order before 11:59 PM and get it tomorrow!
          </p>
          <p class="green-text">
            <i class="fas fa-calendar-alt"></i> Schedule your own delivery time (Mon-Fri)
          </p>
          <p class="green-text">
            <i class="fas fa-star"></i> Avg. customer rating 9 with +2,000 reviews
          </p>
        </div>
       </div> 
    </div>
    <div class="container">
  <?php foreach ($product->getIngredients() as $ingredient): ?>
    <?php
    var_dump($ingredient);
    $searchQuery = urlencode($ingredient->getIngredient());
    $apiUrl = "https://world.openfoodfacts.org/cgi/search.pl?search_terms={$searchQuery}&page-count=1&search_simple=1&json=true&page_size=1";
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);
    $product = $data['products'][0];
    ?>
    <div class="table-responsive mt-5">
      <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nutrient</th>
            <th scope="col">Amount per 100g</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Energy</td>
            <td><?php echo htmlspecialchars($product['nutriments']['energy_kcal']); ?> kcal</td>
          </tr>
          <tr>
            <td>Fat</td>
            <td><?php echo htmlspecialchars($product['nutriments']['fat']); ?> g</td>
          </tr>
          <tr>
            <td>Saturated Fat</td>
            <td><?php echo htmlspecialchars($product['nutriments']['saturated-fat']); ?> g</td>
          </tr>
          <!-- Add more nutrients if needed -->
        </tbody>
      </table>
    </div>
  <?php endforeach; ?>
</div>
  </div> 

