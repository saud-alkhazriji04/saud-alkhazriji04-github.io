<?php

class Controller {
    protected function view($view, $data = []) {
        extract($data);
        
        $view = str_replace('.', '/', $view);
        
        if (file_exists("app/views/{$view}.php")) {
            require_once "app/views/layouts/header.php";
            require_once "app/views/{$view}.php";
            require_once "app/views/layouts/footer.php";
        }
    }
} 