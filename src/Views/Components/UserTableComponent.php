<?php
namespace App\Views\Components;

class UserTableComponent
{
    /**
     * Возвращает HTML-разметку таблицы с контейнером tbody, в который JS вставит строки.
     */
    public function render(): string
    {
        return <<<HTML
<div class="card">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <div class="text-secondary">
                Поиск:
                <div class="ms-2 d-inline-block">
                    <input type="text" id="search-input" class="form-control" placeholder="Введите для поиска...">
                </div>
            </div>
            <div class="btn-list ms-auto">
                <a href="/hr_users/sync" class="btn btn-primary">
                    <!-- plus icon -->
                    Импортировать из HR
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th class="w-1">№</th>
                    <th class="w-1">ID_Emp</th>
                    <th>Pic</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Отчество</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>PINFL</th>
                    <th>Филиал</th>
                    <th>Дата создания</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody id="user-table">
                <!-- Здесь JS вставит строки -->
            </tbody>
        </table>
    </div>
</div>
HTML;
    }
}
