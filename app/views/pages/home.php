<section class="hero">
    <div class="hero-content">
        <h1><?php echo $featuredProduct->name; ?></h1>
        <p class="hero-description"><?php echo $featuredProduct->description; ?></p>
        <div class="hero-price">$<?php echo number_format($featuredProduct->price, 2); ?></div>
        <a href="/CodeExpertsEcommerce/product/<?php echo $featuredProduct->id; ?>" class="cta-button">Shop Now</a>
    </div>
    <div class="hero-image">
        <img src="<?php echo $featuredProduct->image; ?>" alt="Featured Product">
    </div>
</section>

<section class="featured-categories">
    <h2>Popular Categories</h2>
    <div class="category-grid">
        <?php foreach ($categories as $category): ?>
        <div class="category-card">
            <img src="<?php echo $category['image']; ?>" alt="<?php echo $category['name']; ?>">
            <h3><?php echo $category['name']; ?></h3>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="featured-products">
    <div class="section-header">
        <h2>Featured Products</h2>
        <a href="/CodeExpertsEcommerce/products" class="view-all">Show All</a>
    </div>
    <div class="product-grid">
        <?php foreach ($randomProducts as $product): ?>
        <div class="product-card">
            <div class="product-image">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            </div>
            <div class="product-info">
                <h3><?php echo $product['name']; ?></h3>    
                <p class="product-description"><?php echo $product['description']; ?></p>
                <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                <a href="/CodeExpertsEcommerce/product/<?php echo $product['id']; ?>" class="product-button">View Details</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section> 