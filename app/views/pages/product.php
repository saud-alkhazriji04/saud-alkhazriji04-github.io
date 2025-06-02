<div class="product-details">
    <div class="product-details-image">
        <img src="<?php echo $product->image; ?>" alt="<?php echo $product->name; ?>">
    </div>
    <div class="product-details-content">
        <h1><?php echo $product->name; ?></h1>
        <p class="product-details-description"><?php echo $product->description; ?></p>
        <div class="product-details-price">$<?php echo number_format($product->price, 2); ?></div>
        <div class="product-details-category">
            Category: <span><?php echo $product->category; ?></span>
        </div>
        <div class="product-details-actions">
            <button class="add-to-cart-button">Add to Cart</button>
            <a href="/CodeExpertsEcommerce" class="continue-shopping">Continue Shopping</a>
        </div>
    </div>
</div> 