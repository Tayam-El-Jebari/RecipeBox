<body>
  <div class="landing-page-container">
    <h1 class="display-4 fw-bolder"><span class="stretch">RECIPE BOX</span></h1>
    <img src="/img/mockup-box.png" id="bannerImg" alt="banner image"> </img>
    <img src="/img/mockup-box-extra.png" id="extraImg" alt="banner image"> </img>
    <p class="attention-text">
      A compact, quick and easy dinner for healthy individuals,
      our boxes contain all information you might need on your meal,
      Recipe Box is perfect for any kind of individual.</p>
  </div>


  <div class="container" id="food-categories">
    <?php foreach ($foodCategories as $foodCategory) { ?>
      <div class="card ml mr" id="card-banner">
        <a href="/products?foodcategory=<?= $foodCategory->getFoodCategoryID() ?>&<?= str_replace(" ", "-", $foodCategory->getFoodCategoryName()) ?>">
        <img id="card-img-banner" src="<?= $foodCategory->getBannerImage() ?>" alt="<?= $foodCategory->getFoodCategoryName() ?> banner image"> </img>
        <div class="card-img-overlay text-white d-flex flex-column justify-content-center">
          <h4 class="card-title" id="card-title-banner"><?= ucfirst($foodCategory->getFoodCategoryName()) ?> products</h4>
          <div class="link d-flex"></div>
        </div>
        </a>
      </div>
    <?php } ?>
  </div>
  <h1 class="text-center">Recently added products:</h1>
  <hr>
  </hr>
  <div class="product-grid">
    <?php foreach ($products as $key => $product) { ?>
      <div class="card product-card" data-category="<?= $product->getFoodCategory()->getFoodCategoryID() ?>">
        <img class="card-img" src="<?= $product->getImageAddress() ?>" alt="<?= $product->getProductName() ?>-image">
        <div class="flex-row w-full mb-sm">
          <p class="extra-information">kcal : <span><?= $product->getKcal() ?></span></p>
        </div>
        <a href="/products?id=<?= $product->getProductId() ?>">
          <h1 class="product-name"><?= $product->getProductName() ?></h1>
        </a>
        <div class="flex-row">
          <p class="price">€<span><?= number_format($product->getPrice(), 2, ',', '') ?>-</span></p>
          <div class="ml-auto text-center">
            <label for="quantity">Quantity:</label>
            <div class="input-group mb-3 quantity-box" data-product-id="<?= $product->getProductId() ?>">
              <button class="btn btn-outline-secondary" type="button" id="minus" style="background-color: black; color: white;">-</button>
              <input type="number" class="form-control text-center" id="quantity" name="quantity" min="1" max="20" value="1" style="background-color: black; color: white;" readonly>
              <button class="btn btn-outline-secondary" type="button" id="plus" style="background-color: black; color: white;">+</button>
            </div>
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
        <div class="btn-col">
          <a href="/products?id=<?= $product->getProductId() ?>" class="icon-link">
            more info
            <svg fill="none" class="rubicons arrow-right-up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path d="M17.9645 12.9645l.071-7h-7.071" stroke-linecap="round"></path>
              <path d="M5.9645 17.9645l12-12" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </a>
        </div>
      </div>
    <?php } ?>
    <hr>
    </hr>
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