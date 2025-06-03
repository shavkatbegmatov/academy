<?php

namespace App\Controllers;

class UserController
{
    /**
     * Страница синхронизации пользователей (GET /user/sync).
     */
    public function index(): void
    {
        $title = 'Синхронизация пользователей';

        require __DIR__ . '/../Views/layouts/header.php';
        require __DIR__ . '/../Views/users/sync.php';
        require __DIR__ . '/../Views/layouts/footer.php';
    }

    /**
     * Обработчик AJAX POST-запроса для сохранения синхронизации.
     * (POST /api/save-syncuser)
     */
    public function saveSyncUser(): void
    {
        // Примерная логика:
        // Получаем JSON-данные из тела запроса
        $input = json_decode(file_get_contents('php://input'), true);

        $empId = $input['empId'] ?? null;
        $mdlId = $input['mdlId'] ?? null;

        header('Content-Type: application/json; charset=UTF-8');

        if (!$empId) {
            echo json_encode([
                'success' => false,
                'message' => 'empId не указан'
            ]);
            return;
        }

        // Здесь вы бы сделали, например, сохранение в базу через Model или DAO.
        // Для примера вернём всегда success=true:
        echo json_encode([
            'success' => true,
            'message' => 'Синхронизация сохранена'
        ]);
    }

    /**
     * Обработчик GET-запроса для получения списка подходящих пользователей Moodle
     * (GET /api/match-moodle-users?firstname=...&lastname=...)
     */
    public function matchMoodleUsers(): void
    {
        $firstname = $_GET['firstname'] ?? '';
        $lastname  = $_GET['lastname'] ?? '';

        header('Content-Type: application/json; charset=UTF-8');

        // Здесь должна быть логика поиска по базе Moodle.
        // Для примера вернем пустой массив:
        echo json_encode([]);
    }
}
