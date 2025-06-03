<?php
declare(strict_types=1);

use App\Router;

// Router instance’ini olamiz (yoki argument sifatida beramiz)
return function(Router $router): void {
    // GET so‘rovlar
    $router->add('GET', '/',                  ['App\Controllers\UserController', 'index']);
    $router->add('GET', '/user/sync',         ['App\Controllers\UserController', 'index']);
    $router->add('GET', '/users/sync',        ['App\Controllers\UserController', 'index']);
    // Mana shu route’larni xoxlagancha qo‘shimcha qilib qo‘yishingiz mumkin.

    // API endpoint’lari (misol uchun POST so‘rovlari)
    $router->add('POST', '/api/save-syncuser',       ['App\Controllers\UserController', 'saveSyncUser']);
    $router->add('GET',  '/api/match-moodle-users',  ['App\Controllers\UserController', 'matchMoodleUsers']);
    // Agar boshqa kontroller metodlari bo‘lsa, ulardan ham shu yerdagi qo‘llanmalar kabi foydalaning.
};
