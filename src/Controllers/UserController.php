<?php

namespace App\Controllers;

class UserController {
    /**
     * Displays the user synchronization page.
     *
     * @return void
     */
    public function index(): void {

        $title = 'Синхронизация пользователей';

        require __DIR__ . '/../views/layout/header.php';
        require __DIR__ . '/../views/user/sync.php';
        require __DIR__ . '/../views/layout/footer.php';
    }

}