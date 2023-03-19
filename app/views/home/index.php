<body>
  <div class="container landing-page-container">
    <h1 class="display-4 fw-bolder"><span class="stretch">RECIPE BOX</span></h1>
    <img src="/img/mockup-box.png" alt="banner image"> </img>
    <img src="/img/mockup-box-extra.png" id="extraImg" alt="banner image"> </img>
    <p>
      A compact, quick and easy dinner for healthy individuals,
      our boxes contain all information you might need on your meal,
      Recipe Box is perfect for any kind of individual.</p>
  </div>


  <div class="container">
    <?php
    foreach ($foodCategories as $foodCategory) {
      echo '<div class="card" id="card-banner">';
      echo '<img id="card-img-banner" src="' . $foodCategory->getBannerImage() . '" alt="' . $foodCategory->getFoodCategoryName() . ' banner image"> </img>';
      echo '<div class="card-img-overlay text-white d-flex flex-column justify-content-center">';
      echo '<h4 class="card-title" id="card-title-banner">' . ucfirst($foodCategory->getFoodCategoryName()) . ' products</h4>';
      echo '<div class="link d-flex"></div></div></div>';
    }
    ?>
  </div>
  <h1 class="text-center">Recently added products:</h1>
  <hr>
  </hr>
  <div class="product-grid">
    <?php
    foreach ($products as $key => $product) {
      $output = '<div class="card">' .
        '<img class="card-img" src="' . $product->getImageAddress() . '" alt="' . $product->getProductName() . '-image">
      <div class="flex-row w-full mb-sm">
      <p class="extra-information">kcal : <span>' . $product->getKcal() . '</span></p>
      </div> <a href="/products?id=' . $product->getProductId() . '">
      <h1 class="product-name">' . $product->getProductName() . '</h1>
      </a><div class="flex-row"><p class="price">€<span>' . number_format($product->getPrice(), 2, ',', '') . '-</span></p>
      <div class="ml-auto"><label for="quantity' . $key . '">Quantity:</label>
      <div class="quantity-input">
      <button class="min-btn" id="minus-' . $key . '">-</button>
      <input type="number" id="quantity-' . $key . '" name="quantity" min="1" value="1">
      <button class="plus-btn" id="plus-' . $key . '">+</button>
      </div></div></div>
      <div class="btn-col">
      <a href="purchase" class="icon-link">
      Purchase
      <svg fill="none" class="rubicons arrow-right-up" xmlns="http://www.w3.org/2000/svg" width="auto" height="auto" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path d="M17.9645 12.9645l.071-7h-7.071" stroke-linecap="round"></path>
      <path d="M5.9645 17.9645l12-12" stroke-linecap="round" stroke-linejoin="round"></path></svg>
      </a></div>
      <div class="btn-col">
      <a href="/products?id=' . $product->getProductId() . '" class="icon-link">
      more info
      <svg fill="none" class="rubicons arrow-right-up" xmlns="http://www.w3.org/2000/svg" width="auto" height="auto" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path d="M17.9645 12.9645l.071-7h-7.071" stroke-linecap="round"></path>
      <path d="M5.9645 17.9645l12-12" stroke-linecap="round" stroke-linejoin="round"></path></svg>
      </a></div></div>';
      echo $output;
    }


    ?>
    <hr>
    </hr>
  </div>