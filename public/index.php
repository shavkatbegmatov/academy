<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\UserController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/' || $uri === '/users/sync') {
    $ctrl = new UserController();
    $ctrl->index();
} else {
    header("HTTP/1.0 404 Not Found");
    echo '404 Not Found';
}
