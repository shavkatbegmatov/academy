<?php
namespace App\Views\Components;

class UserSyncModalComponent
{
    /**
     * Возвращает HTML модального окна (скрытого по умолчанию).
     */
    public function render(): string
    {
        return <<<HTML
<!-- Modal Structure -->
<div id="userSyncModal" class="modal" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background:#fff; padding:20px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1); z-index:1000; width:90%; max-width:500px;">
    <div class="modal-content">
        <h2>Детали пользователя</h2>
        <div id="userDetails">
            <p><strong>Имя:</strong> <span id="detailFirstname"></span></p>
            <p><strong>Фамилия:</strong> <span id="detailLastname"></span></p>
            <p><strong>Отчество:</strong> <span id="detailMiddlename"></span></p>
            <p><strong>Телефон:</strong> <span id="detailPhone"></span></p>
            <p><strong>Email:</strong> <span id="detailEmail"></span></p>
            <p><strong>PINFL:</strong> <span id="detailPINFL"></span></p>
            <p><strong>Филиал:</strong> <span id="detailBranch"></span></p>
            <p><strong>Дата создания:</strong> <span id="detailCreated"></span></p>
        </div>
        <h3>Соответствие Moodle пользователю</h3>
        <select id="moodleUserSelect" class="form-control">
            <option value="0">Новый пользователь</option>
        </select>
        <input type="hidden" id="currentEmpId" value="">
    </div>
    <div class="modal-footer" style="margin-top:15px; text-align:right;">
        <button id="saveSyncBtn" class="btn btn-success">Сохранить</button>
        <button id="closeModalBtn" class="btn btn-secondary">Закрыть</button>
    </div>
</div>
HTML;
    }
}
