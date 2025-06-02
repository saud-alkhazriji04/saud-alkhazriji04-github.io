<?php

require_once 'app/controllers/HomeController.php';
require_once 'app/controllers/ProductController.php';

$request = $_SERVER['REQUEST_URI'];
$base_path = '/CodeExpertsEcommerce';
$request = str_replace($base_path, '', $request);

// Remove query string from request for routing purposes
$request_path = parse_url($request, PHP_URL_PATH);

// Check for product details route first
if (preg_match('/^\/product\/(\d+)$/', $request_path, $matches)) {
    $controller = new ProductController();
    $controller->show($matches[1]);
    exit;
}

// Simple router for other routes
switch ($request_path) {
    case '/':
    case '':
        $controller = new HomeController();
        $controller->index();
        break;
    
    case '/products':
        $controller = new ProductController();
        $controller->index();
        break;
    
    default:
        http_response_code(404);
        include_once 'app/views/layouts/header.php';
        echo '<div style="text-align: center; padding: 50px;">
                <h1>404 - Page Not Found</h1>
                <p>The page you are looking for does not exist.</p>
                <a href="/CodeExpertsEcommerce" style="color: #3498db; text-decoration: none;">Return to Home</a>
              </div>';
        include_once 'app/views/layouts/footer.php';
        break;
} 