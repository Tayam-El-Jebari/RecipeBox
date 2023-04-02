<body>
  <div class="container products-list-container mb-5 min-vh-85">
    <div class="row">
      <div class="col-md-2 mt-5">


        <div class="filter-container">
          <input type="text" id="search" placeholder="Search...">
          <div id="category-filter">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="category" id="all" value="" checked>
              <label class="form-check-label" for="all">All Categories</label>
            </div>
            <?php foreach ($categories as $categorie) { ?>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="category" id="<?= $categorie->getFoodCategoryName() ?>" value="<?= $categorie->getFoodCategoryID() ?>">
                <label class="form-check-label" for="<?= $categorie->getFoodCategoryName() ?>"><?= $categorie->getFoodCategoryName() ?></label>
              </div>
            <?php } ?>
          </div>
        </div>

      </div>
      <div class="col-md-10">
        <div class="products content-wrapper">
          <h1 class="ml">Products:</h1>
          <div class="product-grid product-grid-small">
            <?php foreach ($products as $product) { ?>
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
                  <div class="ml">
                    <label for="quantity">Quantity:</label>
                    <div class="input-group mb-3 quantity-box" data-product-id="<?= $product->getProductId()?>">
                      <button class="btn btn-outline-secondary" type="button" id="minus" style="background-color: black; color: white;">-</button>
                      <input type="number" class="form-control text-center" id="quantity" name="quantity" min="1" value="1" style="background-color: black; color: white;" readonly>
                      <button class="btn btn-outline-secondary" type="button" id="plus" style="background-color: black; color: white;">+</button>
                    </div>
                  </div>
                </div>
                <div class="btn-col">
                  <a class="icon-link add-to-cart-btn" data-product-id="<?= $product->getProductId(); ?>" >
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
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog" aria-labelledby="addToCartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
      <div class="alert alert-success d-none margin-top" id="alert" role="alert">

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

  <script src="/js/products/products.js"></script>