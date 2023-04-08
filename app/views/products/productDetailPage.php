<body>
  <div class="container mh-vh-100 pt-3">
    <div class="row bg-yellow rounded product d-flex align-items-center justify-content-center shadow rounded">
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
          <div class="card width-100">
            <div class="product-quantity-box text-center width-100 mw-100">
              <label for="quantity">Quantity:</label>
              <div class="input-group mb-3 quantity-box mw-100" data-product-id="<?= $product->getProductId() ?>">
                <button class="btn btn-outline-secondary" type="button" id="minus" style="background-color: black; color: white;">-</button>
                <input type="number" class="form-control text-center" id="quantity" name="quantity" min="1" max="20" value="1" style="background-color: black; color: white;" readonly>
                <button class="btn btn-outline-secondary" type="button" id="plus" style="background-color: black; color: white;">+</button>
              </div>
            </div>
            <div class="btn-col">
              <a class="icon-link add-to-cart-btn" data-product-id="<?= $product->getProductId(); ?>" data-product-name="<?= $product->getProductName(); ?>">
                add to cart
                <svg fill="none" class="rubicons arrow-right-up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path d="M17.9645 12.9645l.071-7h-7.071" stroke-linecap="round"></path>
                  <path d="M5.9645 17.9645l12-12" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <h2> Allergens: </h2>
    <p>
      <?php foreach ($product->getAllergens() as $allergen) { ?>
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
      <?= $ingredient->getIngredient() . ' ' . $ingredient->getIngredientWeight() ?>g
      <?php if ($i !== $ingredientsCount - 1) { ?>;
  <?php }
    } ?>

<h2 class="mt-5">Nutritional facts:</h2>
<div class="spinner-border" id="loading" role="status">
  <span class="sr-only"></span>
</div>
<div class="container">
  <?php foreach ($product->getIngredients() as $ingredient) { ?>
    <div class="nutritional-data" data-ingredient="<?= urlencode($ingredient->getIngredient()) ?>" data-ingredient-weight="<?= $ingredient->getIngredientWeight() //data will be loaded with ?>">
    </div>
  <?php } ?>
</div>
    <div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog" aria-labelledby="addToCartModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="alert alert-success margin-top" id="alertModal" role="alert">

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continue browsing</button>
            <a href="/cart" class="btn btn-primary">Go to cart</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>