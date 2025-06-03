class UserSyncApp {
    constructor() {
        this.apiUrl = 'https://academy-api.brb.uz/api/employers';
        this.searchInput = document.getElementById('search-input');
        this.userTableBody = document.getElementById('user-table');
        this.modal = document.getElementById('userSyncModal');
        this.detailFields = {
            firstname: document.getElementById('detailFirstname'),
            lastname: document.getElementById('detailLastname'),
            middlename: document.getElementById('detailMiddlename'),
            phone: document.getElementById('detailPhone'),
            email: document.getElementById('detailEmail'),
            pinfl: document.getElementById('detailPINFL'),
            branch: document.getElementById('detailBranch'),
            created: document.getElementById('detailCreated'),
        };
        this.currentEmpIdInput = document.getElementById('currentEmpId');
        this.moodleSelect = document.getElementById('moodleUserSelect');
        this.saveBtn = document.getElementById('saveSyncBtn');
        this.closeBtn = document.getElementById('closeModalBtn');

        this.attachEvents();
        this.loadUsers();
    }

    attachEvents() {
        this.searchInput.addEventListener('input', () => this.filterTable());
        this.saveBtn.addEventListener('click', () => this.saveSync());
        this.closeBtn.addEventListener('click', () => this.hideModal());
    }

    async loadUsers() {
        try {
            const response = await fetch(this.apiUrl);
            const data = await response.json();
            this.populateTable(data);
        } catch (err) {
            console.error('Ошибка при загрузке пользователей:', err);
        }
    }

    populateTable(data) {
        this.userTableBody.innerHTML = '';
        let nn = 0;

        data.forEach(user => {
            const date = new Date(user.creationDate);
            const formattedDate = date.toLocaleString('uz-UZ');

            const row = document.createElement('tr');
            row.classList.add('user-row');
            row.dataset.empid      = user.empId || '';
            row.dataset.firstname  = user.firstName || '';
            row.dataset.lastname   = user.lastName || '';
            row.dataset.middlename = user.middleName || '';
            row.dataset.phone      = user.phoneMobil || '';
            row.dataset.email      = user.email || '';
            row.dataset.pinfl      = user.pinfl || '';
            row.dataset.branch     = user.branchId || '';
            row.dataset.created    = formattedDate || '';

            row.innerHTML = `
                <td class="filterable">${++nn}</td>
                <td class="filterable">${user.empId || ''}</td>
                <td class="filterable">
                    <span class="avatar avatar-sm me-3" style="background: url('https://api.dicebear.com/9.x/${encodeURIComponent(user.firstName)}/svg?seed=${encodeURIComponent(user.firstName)}')"></span>
                </td>
                <td class="filterable">${user.firstName || ''}</td>
                <td class="filterable">${user.lastName || ''}</td>
                <td class="filterable">${user.middleName || ''}</td>
                <td class="filterable">${user.phoneMobil || ''}</td>
                <td class="filterable">${user.email || ''}</td>
                <td class="filterable">${user.pinfl || ''}</td>
                <td class="filterable">${user.branchId || ''}</td>
                <td class="filterable">${formattedDate || ''}</td>
                <td class="text-end">
                    <a href="/hr_user/sync/${user.empId}" class="btn btn-icon btn-outline-danger" 
                       onclick="event.stopPropagation(); return confirm('Вы точно хотите синхронизировать пользователя «${user.firstName}»?');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                             class="icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                        </svg>
                    </a>
                </td>
            `;
            this.userTableBody.appendChild(row);

            // Навешиваем открытие модального окна
            row.addEventListener('click', () => this.openModal(row));
        });
    }

    openModal(row) {
        // Заполняем детали
        this.detailFields.firstname.textContent  = row.dataset.firstname;
        this.detailFields.lastname.textContent   = row.dataset.lastname;
        this.detailFields.middlename.textContent = row.dataset.middlename;
        this.detailFields.phone.textContent      = row.dataset.phone;
        this.detailFields.email.textContent      = row.dataset.email;
        this.detailFields.pinfl.textContent      = row.dataset.pinfl;
        this.detailFields.branch.textContent     = row.dataset.branch;
        this.detailFields.created.textContent    = row.dataset.created;
        this.currentEmpIdInput.value             = row.dataset.empid;

        // Показываем модалку
        this.modal.style.display = 'block';

        // Загружаем соответствие Moodle-пользователей
        const params = new URLSearchParams({
            firstname: row.dataset.firstname,
            lastname: row.dataset.lastname
        });
        fetch(`/api/match-moodle-users?${params.toString()}`)
            .then(res => res.json())
            .then(data => this.populateMoodleSelect(data))
            .catch(err => console.error('Ошибка при загрузке Moodle-пользователей:', err));
    }

    populateMoodleSelect(users) {
        this.moodleSelect.innerHTML = '<option value="0">Новый пользователь</option>';
        users.forEach(u => {
            const opt = document.createElement('option');
            opt.value = u.id;
            opt.textContent = `${u.firstname} ${u.lastname}` + (u.email ? ` (${u.email})` : '');
            this.moodleSelect.appendChild(opt);
        });
    }

    hideModal() {
        this.modal.style.display = 'none';
    }

    async saveSync() {
        const empId = this.currentEmpIdInput.value;
        const mdlId = this.moodleSelect.value;
        const payload = { empId, mdlId };

        try {
            const res = await fetch('/api/save-syncuser', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const data = await res.json();
            if (data.success) {
                alert('Синхронизация сохранена');
                this.hideModal();
            } else {
                alert('Ошибка: ' + data.message);
            }
        } catch (err) {
            console.error('Ошибка при сохранении:', err);
        }
    }

    filterTable() {
        const filter = this.searchInput.value.toLowerCase();
        this.userTableBody.querySelectorAll('tr').forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    }
}

// Инициализируем приложение, когда DOM загрузится
document.addEventListener('DOMContentLoaded', () => {
    new UserSyncApp();
});
