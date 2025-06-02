<?php

require_once 'Controller.php';
require_once 'app/data/products.php';

class ProductController extends Controller {
    public function index() {
        global $products, $categories;
        
        // Get filter parameters
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        $min_price = isset($_GET['min_price']) ? floatval($_GET['min_price']) : 0;
        $max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) : 9999;

        // Filter products
        $filtered_products = array_filter($products, function($product) use ($category, $min_price, $max_price) {
            // Debug category matching
            error_log("Checking product: " . $product['name']);
            error_log("Product category: " . $product['category']);
            error_log("Selected category: " . $category);
            
            // Fix category matching logic
            $category_match = empty($category) || trim($product['category']) === trim($category);
            $price_match = $product['price'] >= $min_price && $product['price'] <= $max_price;
            
            error_log("Category match: " . ($category_match ? 'true' : 'false'));
            error_log("Price match: " . ($price_match ? 'true' : 'false'));
            
            return $category_match && $price_match;
        });

        // Debug filtered results
        error_log("Total products before filter: " . count($products));
        error_log("Total products after filter: " . count($filtered_products));

        return $this->view('pages.all_products', [
            'products' => array_values($filtered_products),
            'categories' => $categories,
            'selected_category' => $category,
            'selected_min_price' => $min_price,
            'selected_max_price' => $max_price === 9999 ? 9999 : $max_price
        ]);
    }

    public function show($id) {
        global $products;
        
        // Find the product by ID
        $product = null;
        foreach ($products as $p) {
            if ($p['id'] == $id) {
                $product = (object)$p;
                break;
            }
        }
        
        // If product not found, redirect to home
        if (!$product) {
            header('Location: /CodeExpertsEcommerce');
            exit;
        }
        
        return $this->view('pages.product', [
            'product' => $product
        ]);
    }
} 