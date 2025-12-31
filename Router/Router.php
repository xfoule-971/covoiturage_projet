<?php
namespace Router;

class Router {
    private $routes = [];

    // Ajouter une route GET
    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    // Ajouter une route POST
    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    // Ajouter une route GET+POST
    public function match($path, $callback, array $methods = ['GET', 'POST']) {
        foreach ($methods as $method) {
            $this->routes[$method][$path] = $callback;
        }
    }

    // Lancer le router
    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // === Adaptation pour sous-dossier ===
        $basePath = '/covoiturage-projet/public';
        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        if ($uri === '') {
            $uri = '/';
        }

        // Vérifie si la route existe
        if (isset($this->routes[$method][$uri])) {
            call_user_func($this->routes[$method][$uri]);
        } else {
            http_response_code(404);
            echo "<h1>404 - Page not found</h1>";
        }
    }
}






