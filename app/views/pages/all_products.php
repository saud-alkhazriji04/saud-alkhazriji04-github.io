<div class="products-page">
    <!-- Mobile Filter Toggle -->
    <button class="filter-toggle" onclick="toggleFilters()">
        <span>Filters</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 6h18M6 12h12m-9 6h6"/>
        </svg>
    </button>

    <!-- Filters Sidebar -->
    <aside class="filters-sidebar">
        <div class="filters-content">
            <h2>Filters</h2>
            <form id="filter-form" action="/CodeExpertsEcommerce/products" method="GET">
                <!-- Debug info -->
                <div style="display: none;">
                    Selected category: <?php echo htmlspecialchars($selected_category); ?>
                </div>

                <div class="filter-section">
                    <h3>Category</h3>
                    <div class="filter-options">
                        <label class="filter-option">
                            <input type="radio" name="category" value="" <?php echo empty($selected_category) ? 'checked' : ''; ?>>
                            <span>All Categories</span>
                        </label>
                        <?php foreach ($categories as $category): ?>
                        <label class="filter-option">
                            <input type="radio" name="category" value="<?php echo htmlspecialchars($category['name']); ?>" 
                                <?php echo $selected_category === $category['name'] ? 'checked' : ''; ?>>
                            <span><?php echo htmlspecialchars($category['name']); ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Price Range</h3>
                    <div class="price-inputs">
                        <div class="price-input">
                            <label for="min_price">Min</label>
                            <div class="input-wrapper">
                                <span>$</span>
                                <input type="number" id="min_price" name="min_price" 
                                    min="0" 
                                    max="9999" 
                                    value="<?php echo $selected_min_price; ?>">
                            </div>
                        </div>
                        <div class="price-input">
                            <label for="max_price">Max</label>
                            <div class="input-wrapper">
                                <span>$</span>
                                <input type="number" id="max_price" name="max_price" 
                                    min="0" 
                                    max="9999" 
                                    value="<?php echo $selected_max_price; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="apply-filters">Apply Filters</button>
            </form>
        </div>
    </aside>

    <!-- Products Grid -->
    <div class="products-content">
        <h1>All Products</h1>
        <?php if (empty($products)): ?>
        <div class="no-products">
            <p>No products found matching your criteria.</p>
        </div>
        <?php else: ?>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                </div>
                <div class="product-info">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                    <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                    <a href="/CodeExpertsEcommerce/product/<?php echo $product['id']; ?>" class="product-button">View Details</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
function toggleFilters() {
    document.querySelector('.filters-sidebar').classList.toggle('active');
}

// Close filters when clicking outside on mobile
document.addEventListener('click', function(event) {
    const sidebar = document.querySelector('.filters-sidebar');
    const toggle = document.querySelector('.filter-toggle');
    if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
        sidebar.classList.remove('active');
    }
});

// Auto-submit form when category changes
document.querySelectorAll('input[name="category"]').forEach(radio => {
    radio.addEventListener('change', function() {
        // Preserve current price range values
        const minPrice = document.getElementById('min_price').value;
        const maxPrice = document.getElementById('max_price').value;
        
        // Create URL with parameters
        const url = new URL(document.getElementById('filter-form').action);
        url.searchParams.set('category', this.value);
        if (minPrice) url.searchParams.set('min_price', minPrice);
        if (maxPrice) url.searchParams.set('max_price', maxPrice);
        
        // Navigate to the URL
        window.location.href = url.toString();
    });
});

// Handle price filter submission
document.getElementById('filter-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get current values
    const category = document.querySelector('input[name="category"]:checked').value;
    const minPrice = document.getElementById('min_price').value;
    const maxPrice = document.getElementById('max_price').value;
    
    // Create URL with parameters
    const url = new URL(this.action);
    if (category) url.searchParams.set('category', category);
    if (minPrice) url.searchParams.set('min_price', minPrice);
    if (maxPrice) url.searchParams.set('max_price', maxPrice);
    
    // Navigate to the URL
    window.location.href = url.toString();
});
</script> 