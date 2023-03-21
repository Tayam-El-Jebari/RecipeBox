<body>
<div class="products content-wrapper">
    <h1 class="ml">Products:</h1>
    <div class="product-grid product-grid-small">
    <?php
    foreach ($products as $product) {
      $output = '<div class="card">' .
      '<img class="card-img" src="' . $product->getImageAddress() . '" alt="' . $product->getProductName() . '-image">
      <div class="flex-row w-full mb-sm">
      <p class="extra-information">kcal : <span>' . $product->getKcal() . '</span></p>
      </div> <a href="/products?id=' . $product->getProductId() . '">
      <h1 class="product-name">' . $product->getProductName() . '</h1>
      </a><div class="flex-row"><p class="price">€<span>' . number_format($product->getPrice(), 2, ',', '') . '-</span></p>
      <div class="ml-auto"><label for="quantity">Quantity:</label>
      <div class="quantity-input">
      <button class="min-btn" id="minus">-</button>
      <input type="number" id="quantity" name="quantity" min="1" value="1">
      <button class="plus-btn" id="plus">+</button>
      </div></div></div>
      <div class="btn-col">
      <a href="purchase" class="icon-link">
      Purchase
      <svg fill="none" class="rubicons arrow-right-up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path d="M17.9645 12.9645l.071-7h-7.071" stroke-linecap="round"></path>
      <path d="M5.9645 17.9645l12-12" stroke-linecap="round" stroke-linejoin="round"></path></svg>
      </a></div>
      <div class="btn-col">
      <a href="/products?id='. $product->getProductId() .'" class="icon-link">
      more info
      <svg fill="none" class="rubicons arrow-right-up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path d="M17.9645 12.9645l.071-7h-7.071" stroke-linecap="round"></path>
      <path d="M5.9645 17.9645l12-12" stroke-linecap="round" stroke-linejoin="round"></path></svg>
      </a></div></div>';
      echo $output;
    }?>
    </div>
</div>