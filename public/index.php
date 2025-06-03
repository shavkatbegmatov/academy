<?php
declare(strict_types=1);

// Autoload
require_once __DIR__ . '/../vendor/autoload.php';

use App\Router;

$router = new Router();

$routesDefinition = require __DIR__ . '/../src/Routes/web.php';

$routesDefinition($router);

$router->dispatch();
