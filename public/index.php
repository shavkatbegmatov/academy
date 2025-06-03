<?php
// public/index.php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\UserController;

// Можно получать заголовок из параметров или оставлять по умолчанию:
$title = 'Синхронизация пользователей';

$controller = new UserController($title);
$controller->render();
