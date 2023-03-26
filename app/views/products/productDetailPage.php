<body>  
<div class="product-detail-grid">
<img class="card-img product-detail-image" src=" <?= $product->getImageAddress() ?> " alt="'<?= $product->getProductName() ?> '-image">
<div>
    <h1> <?php echo $product->getProductName();?> </h1>
    </a><div class="flex-row"><p class="price">€<span><?= number_format($product->getPrice(), 2, ',', '') ?>-</span></p>
      <div class="ml-auto"><label for="quantity">Quantity:</label>
      <div class="quantity-input">
      <button class="min-btn" id="minus">-</button>
      <input type="number" id="quantity" name="quantity" min="1" value="1">
      <button class="plus-btn" id="plus">+</button>
      </div></div></div>
      <div class="btn-col">

</div>
</div>
</body>

