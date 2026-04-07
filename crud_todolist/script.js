// API Base URL - Cambiar según la configuración
const API_BASE = 'http://localhost/Base-de-datos-2/crud_todolist';

// DOM Elements
const taskInput = document.getElementById('taskInput');
const addBtn = document.getElementById('addBtn');
const tasksContainer = document.getElementById('tasksContainer');
const emptyState = document.getElementById('emptyState');
const filterButtons = document.querySelectorAll('.filter-btn');
const editModal = document.getElementById('editModal');
const editTaskInput = document.getElementById('editTaskInput');
const closeModal = document.getElementById('closeModal');
const cancelBtn = document.getElementById('cancelBtn');
const saveBtn = document.getElementById('saveBtn');
const toast = document.getElementById('toast');

// State
let allTasks = [];
let currentFilter = 'all';
let editingTaskId = null;

// Inicializar la aplicación
document.addEventListener('DOMContentLoaded', () => {
    loadTasks();
    setupEventListeners();
});

// Event Listeners
function setupEventListeners() {
    // Agregar tarea
    addBtn.addEventListener('click', addTask);
    taskInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') addTask();
    });

    // Filtros
    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentFilter = btn.dataset.filter;
            renderTasks();
        });
    });

    // Modal
    closeModal.addEventListener('click', closeEditModal);
    cancelBtn.addEventListener('click', closeEditModal);
    saveBtn.addEventListener('click', saveEditedTask);
    editModal.addEventListener('click', (e) => {
        if (e.target === editModal) closeEditModal();
    });
    editTaskInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') saveEditedTask();
    });
}

// ============ CRUD Operations ============

// 1. CREATE - Agregar nueva tarea
async function addTask() {
    const title = taskInput.value.trim();

    if (title === '') {
        showToast('⚠️ Por favor, escribe una tarea', 'error');
        return;
    }

    try {
        const response = await fetch(`${API_BASE}/api_create.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ title })
        });

        const data = await response.json();

        if (data.success) {
            showToast('✓ Tarea agregada exitosamente', 'success');
            taskInput.value = '';
            taskInput.focus();
            loadTasks();
        } else {
            showToast('✗ Error al agregar la tarea', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('✗ Error de conexión', 'error');
    }
}

// 2. READ - Cargar todas las tareas
async function loadTasks() {
    try {
        const response = await fetch(`${API_BASE}/api_read.php`);
        const data = await response.json();

        if (data.success) {
            allTasks = data.data || [];
            renderTasks();
            updateFilterCounts();
        } else {
            showToast('✗ Error al cargar las tareas', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('✗ Error de conexión', 'error');
    }
}

// 3. UPDATE - Actualizar tarea (título o completed)
async function updateTask(id, updates) {
    try {
        const response = await fetch(`${API_BASE}/api_update.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id, ...updates })
        });

        const data = await response.json();

        if (data.success) {
            showToast('✓ Tarea actualizada', 'success');
            loadTasks();
        } else {
            showToast('✗ Error al actualizar la tarea', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('✗ Error de conexión', 'error');
    }
}

// 4. DELETE - Eliminar tarea
async function deleteTask(id) {
    if (!confirm('¿Estás seguro de que deseas eliminar esta tarea?')) {
        return;
    }

    try {
        const response = await fetch(`${API_BASE}/api_delete.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id })
        });

        const data = await response.json();

        if (data.success) {
            showToast('✓ Tarea eliminada', 'success');
            loadTasks();
        } else {
            showToast('✗ Error al eliminar la tarea', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('✗ Error de conexión', 'error');
    }
}

// ============ UI Functions ============

// Renderizar tareas según el filtro
function renderTasks() {
    tasksContainer.innerHTML = '';

    let filteredTasks = allTasks;

    // Aplicar filtro
    if (currentFilter === 'pending') {
        filteredTasks = allTasks.filter(task => !task.completed);
    } else if (currentFilter === 'completed') {
        filteredTasks = allTasks.filter(task => task.completed);
    }

    // Mostrar estado vacío si no hay tareas
    if (filteredTasks.length === 0) {
        emptyState.classList.add('show');
        return;
    }

    emptyState.classList.remove('show');

    // Renderizar tarjetas
    filteredTasks.forEach(task => {
        const taskCard = createTaskCard(task);
        tasksContainer.appendChild(taskCard);
    });
}

// Crear elemento de tarjeta de tarea
function createTaskCard(task) {
    const card = document.createElement('div');
    card.className = `task-card ${task.completed ? 'completed' : ''}`;

    const createdAt = new Date(task.created_at).toLocaleDateString('es-ES', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });

    card.innerHTML = `
        <div class="task-content">
            <div class="task-title">${escapeHtml(task.title)}</div>
            <div class="task-date">${createdAt}</div>
        </div>
        <div class="task-actions">
            <button class="btn-icon btn-complete ${task.completed ? 'completed' : ''}" onclick="toggleTask(${task.id})" title="Marcar como completado">
                ${task.completed ? '✓' : '◯'}
            </button>
            <button class="btn-icon btn-edit" onclick="openEditModal(${task.id}, '${escapeHtml(task.title)}')">
                ✏️
            </button>
            <button class="btn-icon btn-delete" onclick="deleteTask(${task.id})">
                🗑️
            </button>
        </div>
    `;

    return card;
}

// Toggle completar/incompletar tarea
function toggleTask(id) {
    const task = allTasks.find(t => t.id === id);
    if (task) {
        updateTask(id, { completed: !task.completed });
    }
}

// Abrir modal para editar
function openEditModal(id, currentTitle) {
    editingTaskId = id;
    editTaskInput.value = currentTitle;
    editModal.classList.add('show');
    editTaskInput.focus();
}

// Cerrar modal
function closeEditModal() {
    editModal.classList.remove('show');
    editingTaskId = null;
    editTaskInput.value = '';
}

// Guardar cambios de la tarea
function saveEditedTask() {
    const newTitle = editTaskInput.value.trim();

    if (newTitle === '') {
        showToast('⚠️ El título no puede estar vacío', 'error');
        return;
    }

    if (editingTaskId !== null) {
        updateTask(editingTaskId, { title: newTitle });
        closeEditModal();
    }
}

// Actualizar contadores de filtros
function updateFilterCounts() {
    const pendingCount = allTasks.filter(t => !t.completed).length;
    const completedCount = allTasks.filter(t => t.completed).length;
    const totalCount = allTasks.length;

    document.getElementById('count-all').textContent = totalCount;
    document.getElementById('count-pending').textContent = pendingCount;
    document.getElementById('count-completed').textContent = completedCount;
}

// ============ Utility Functions ============

// Mostrar notificación toast
function showToast(message, type = 'info') {
    toast.textContent = message;
    toast.className = `toast ${type} show`;

    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// Escapar caracteres HTML para evitar XSS
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
