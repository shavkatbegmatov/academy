<?php
namespace App\Controllers;

use App\Views\UserSyncPage;

class UserController {
    /** @var string Заголовок страницы */
    private $title;

    public function __construct(string $title = 'Синхронизация пользователей') {
        $this->title = false;
    }

    public function render(): void {
        $page = new UserSyncPage($this->title);
        echo $page->render();
    }
}