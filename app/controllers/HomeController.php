<?php

require_once 'Controller.php';
require_once 'app/data/products.php';

class HomeController extends Controller {
    public function index() {
        global $products, $categories;
        
        // Get the first product as featured product
        $featuredProduct = (object)$products[0];
        
        // Get 4 random products (excluding the featured one)
        $randomProducts = $this->getRandomProducts($products, 4, $featuredProduct->id);
        
        return $this->view('pages.home', [
            'featuredProduct' => $featuredProduct,
            'categories' => $categories,
            'randomProducts' => $randomProducts
        ]);
    }

    private function getRandomProducts($products, $count, $excludeId) {
        // Remove the featured product
        $availableProducts = array_filter($products, function($product) use ($excludeId) {
            return $product['id'] !== $excludeId;
        });
        
        // Shuffle the array
        shuffle($availableProducts);
        
        // Return the first $count items
        return array_slice($availableProducts, 0, $count);
    }
} 