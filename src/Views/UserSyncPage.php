<?php
namespace App\Views;

use App\Views\Components\UserTableComponent;
use App\Views\Components\UserSyncModalComponent;

class UserSyncPage {
    /** @var string */
    private $title;

    public function __construct(string $title) {
        $this->title = $title;
    }

    /**
     * Возвращает HTML всей страницы.
     */
    public function render(): string {
        // Собираем компоненты
        $tableComponent = new UserTableComponent();
        $modalComponent = new UserSyncModalComponent();

        // Собираем компоненты
        $html = [];
        $html[] = '<!DOCTYPE html>';
        $html[] = '<html lang="ru">';
        $html[] = '<head>';
        $html[] = '    <meta charset="UTF-8">';
        $html[] = "    <title>{$this->escape($this->title)}</title>";
        $html[] = '    <link rel="stylesheet" href="/path/to/your/css/framework.css">';
        $html[] = '</head>';
        $html[] = '<body>';
        $html[] = '    <div class="container">';
        $html[] = "        <h1>{$this->escape($this->title)}</h1>";
        $html[] = $tableComponent->render();
        $html[] = $modalComponent->render();
        $html[] = '    </div>';
        $html[] = '    <script src="/js/UserSyncApp.js"></script>';
        $html[] = '</body>';
        $html[] = '</html>';

        return implode("\n", $html);
    }

    /**
     * Экранирование для безопастного вывода.
     */
    private function escape(string $str): string {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
}