<?php
declare(strict_types=1);

namespace App;

class Router
{
    /**
     * Struktura:
     * [
     *   'GET' => [
     *       '/user/sync' => ['App\Controllers\UserController', 'index'],
     *       ...
     *   ],
     *   'POST' => [
     *       '/api/save-syncuser' => ['App\Controllers\UserController', 'saveSyncUser'],
     *       ...
     *   ],
     *   ...
     * ]
     *
     * @var array<string, array<string, array{0:string,1:string}>>
     */
    protected array $routes = [];

    /**
     * Yangi route qo‘shadi.
     *
     * @param string $method  HTTP metodi (GET, POST, PUT, DELETE va hokazo)
     * @param string $path    URI yo‘l ("/user/sync", "/api/save-syncuser" va hk)
     * @param string $handler Kontroller va metod, array sifatida: [’App\Controllers\UserController’, ’index’]
     */
    public function add(string $method, string $path, array $handler): void
    {
        $method = strtoupper($method);
        $this->routes[$method][$path] = $handler;
    }

    /**
     * Kelgan so‘rov URI va metodga mos handler'ni topib chaqiradi.
     * Agar route topilmasa — 404 beradi.
     */
    public function dispatch(): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Bazida base path bilan ishlash kerak bo‘lsa, shu yerda olib tashlash mumkin.
        // Masalan, agar loyihangiz public katalog ostida bo‘lsa: '/academy/public/...'
        // O‘sha base path’ni olib tashlang, lekin misolda buni kerak deb hisoblamaymiz.

        $routesForMethod = $this->routes[$requestMethod] ?? [];

        if (isset($routesForMethod[$requestUri])) {
            [$controllerClass, $method] = $routesForMethod[$requestUri];
            if (class_exists($controllerClass) && method_exists($controllerClass, $method)) {
                // Kontroller instance yaratib, metodni chaqiramiz
                $controller = new $controllerClass();
                $controller->{$method}();
                return;
            }
        }

        // Agar mos kelmas ekan — 404 Not Found
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }
}
