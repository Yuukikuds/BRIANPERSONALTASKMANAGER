<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BRIAN MANAGER</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        darkbg: '#0b0e14',
                        glass: 'rgba(255,255,255,0.04)',
                        glassborder: 'rgba(255,255,255,0.10)',
                        accent: '#8b9dff'
                    },
                    backdropBlur: {
                        xs: '2px'
                    }
                }
            }
        }
    </script>
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at 15% 10%, rgba(139,157,255,0.12), transparent 40%),
                radial-gradient(circle at 85% 85%, rgba(139,157,255,0.08), transparent 45%),
                #0b0e14;
            min-height: 100vh;
        }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.12); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }

        .glass {
            background: rgba(255,255,255,0.035);
            border: 1px solid rgba(255,255,255,0.10);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        .glass-strong {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.14);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .glass-hover:hover {
            background: rgba(255,255,255,0.06);
            border-color: rgba(255,255,255,0.18);
        }
        .input-glass {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.10);
        }
        .input-glass:focus {
            background: rgba(255,255,255,0.05);
            border-color: rgba(139,157,255,0.5);
        }
    </style>
</head>
<body class="text-slate-100 flex flex-col md:flex-row selection:bg-indigo-500/40 selection:text-white">

    <!-- Sidebar Navigation -->
    <aside class="w-full md:w-64 glass border-b md:border-b-0 md:border-r border-white/10 flex flex-col justify-between shrink-0 z-20 md:h-screen md:sticky md:top-0">
        <div>
            <!-- App Branding -->
            <div class="h-20 flex items-center px-6 border-b border-white/10 gap-3">
                <div class="w-10 h-10 rounded-xl glass-strong flex items-center justify-center text-accent">
                    <i class="fa-solid fa-layer-group text-lg"></i>
                </div>
                <div>
                    <h1 class="font-semibold text-base tracking-wide text-white">BRIAN'S TASK MANAGER</h1>
                    <span class="text-xs text-slate-400">Workspace</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1.5">
                <a href="#" onclick="filterTasks('all')" id="nav-all" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium glass-strong text-white transition-all">
                    <i class="fa-solid fa-house w-5 text-accent"></i> All Tasks <span id="count-all" class="ml-auto bg-white/10 text-slate-200 px-2 py-0.5 rounded-full text-xs font-medium">0</span>
                </a>
                <a href="#" onclick="filterTasks('pending')" id="nav-pending" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-400 hover:text-white glass-hover border border-transparent transition-all">
                    <i class="fa-solid fa-clock w-5 text-amber-300"></i> Pending <span id="count-pending" class="ml-auto bg-white/5 text-slate-300 px-2 py-0.5 rounded-full text-xs font-medium">0</span>
                </a>
                <a href="#" onclick="filterTasks('completed')" id="nav-completed" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-400 hover:text-white glass-hover border border-transparent transition-all">
                    <i class="fa-solid fa-circle-check w-5 text-emerald-300"></i> Completed <span id="count-completed" class="ml-auto bg-white/5 text-slate-300 px-2 py-0.5 rounded-full text-xs font-medium">0</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer profile -->
        <div class="p-4 border-t border-white/10">
            <div class="flex items-center gap-3 p-3 rounded-xl glass">
                <div class="w-9 h-9 rounded-full glass-strong text-accent flex items-center justify-center font-semibold text-sm">
                    BM
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-medium text-slate-200 truncate">BRIAN MABINI</p>
                    <p class="text-xs text-slate-500 truncate">mabinibrianjr@gmail.com</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col min-w-0">

        <!-- Top Header Bar -->
        <header class="h-20 glass border-b border-white/10 px-6 md:px-10 flex items-center justify-between sticky top-0 z-10">
            <div class="flex items-center gap-4 flex-1 max-w-xl">
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </span>
                    <input type="text" id="searchInput" oninput="handleSearch()" placeholder="Search tasks by title or tag..." class="w-full input-glass rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-200 placeholder-slate-500 focus:outline-none transition-all">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button onclick="openModal()" class="flex items-center gap-2 glass-strong hover:bg-white/10 text-white font-medium px-4 py-2.5 rounded-xl transition-all text-sm active:scale-95">
                    <i class="fa-solid fa-plus text-accent"></i>
                    <span>New Task</span>
                </button>
            </div>
        </header>

        <!-- Dynamic Flash Notification Banner -->
        <div id="flashMessage" class="hidden mx-6 md:mx-10 mt-6 p-4 rounded-xl glass flex items-center gap-3 text-sm transition-all duration-300">
            <i id="flashIcon" class="fa-solid text-base"></i>
            <span id="flashText" class="font-medium"></span>
        </div>

        <!-- Dashboard View Container -->
        <div class="p-6 md:p-10 space-y-8 flex-1 max-w-7xl w-full mx-auto">

            <!-- Stats Bar -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="glass rounded-2xl p-5 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400 font-medium mb-1">Total Tasks</p>
                        <h3 id="statTotal" class="text-2xl font-semibold text-white">0</h3>
                    </div>
                    <div class="w-11 h-11 rounded-xl glass-strong text-accent flex items-center justify-center text-lg">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                </div>
                <div class="glass rounded-2xl p-5 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400 font-medium mb-1">Pending Tasks</p>
                        <h3 id="statPending" class="text-2xl font-semibold text-white">0</h3>
                    </div>
                    <div class="w-11 h-11 rounded-xl glass-strong text-amber-300 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                </div>
                <div class="glass rounded-2xl p-5 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400 font-medium mb-1">Completed</p>
                        <h3 id="statCompleted" class="text-2xl font-semibold text-white">0</h3>
                    </div>
                    <div class="w-11 h-11 rounded-xl glass-strong text-emerald-300 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
            </div>

            <!-- Task Grid Card Wrapper -->
            <div class="glass rounded-2xl overflow-hidden">
                <!-- Card Header -->
                <div class="p-6 border-b border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-base font-semibold text-white flex items-center gap-2">
                            <span>Task Registry</span>
                            <span id="currentFilterBadge" class="text-xs px-2.5 py-0.5 rounded-full glass-strong text-slate-200 font-medium">All Tasks</span>
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">Manage, edit, and track progress of your deliverables.</p>
                    </div>

                    <!-- View Switcher & Filter Controls -->
                    <div class="flex items-center gap-2 self-start sm:self-auto">
                        <select id="priorityFilter" onchange="applyFilters()" class="input-glass rounded-xl px-3 py-2 text-xs text-slate-300 focus:outline-none transition-all">
                            <option value="all">All Priorities</option>
                            <option value="High">High Priority</option>
                            <option value="Medium">Medium Priority</option>
                            <option value="Low">Low Priority</option>
                        </select>
                        <div class="flex items-center glass rounded-xl p-1">
                            <button onclick="setViewMode('table')" id="btnViewTable" class="p-1.5 rounded-lg text-white glass-strong transition-all text-xs px-2.5 font-medium flex items-center gap-1.5">
                                <i class="fa-solid fa-table-cells-row-slash"></i> Table
                            </button>
                            <button onclick="setViewMode('grid')" id="btnViewGrid" class="p-1.5 rounded-lg text-slate-400 hover:text-white transition-all text-xs px-2.5 font-medium flex items-center gap-1.5">
                                <i class="fa-solid fa-border-all"></i> Grid
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Empty State (Hidden by default) -->
                <div id="emptyState" class="hidden py-20 px-6 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl glass flex items-center justify-center text-slate-500 text-2xl">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <h3 class="text-base font-medium text-slate-300">No tasks found</h3>
                    <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Get started by creating a new task item using the button above.</p>
                </div>

                <!-- Table View Container -->
                <div id="tableViewContainer" class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/10 text-slate-500 text-xs font-medium">
                                <th class="py-4 px-6">Task Details</th>
                                <th class="py-4 px-6">Priority</th>
                                <th class="py-4 px-6">Due Date</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="taskTableBody" class="divide-y divide-white/5 text-sm">
                            <!-- Injected dynamically via JS -->
                        </tbody>
                    </table>
                </div>

                <!-- Grid Card View Container (Hidden by default) -->
                <div id="gridViewContainer" class="hidden p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Injected dynamically via JS -->
                </div>
            </div>

        </div>
    </main>

    <!-- Add/Edit Task Modal Dialog -->
    <div id="taskModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm hidden opacity-0 transition-opacity duration-200">
        <div class="glass-strong w-full max-w-lg rounded-2xl overflow-hidden transform scale-95 transition-transform duration-200 shadow-2xl" id="modalCard">
            <div class="flex items-center justify-between px-6 py-5 border-b border-white/10">
                <h3 id="modalTitle" class="font-semibold text-white text-base flex items-center gap-2">
                    <i class="fa-solid fa-circle-plus text-accent"></i> Create New Task
                </h3>
                <button onclick="closeModal()" class="w-8 h-8 rounded-lg glass text-slate-400 hover:text-white flex items-center justify-center transition-all">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form id="taskForm" onsubmit="handleFormSubmit(event)" class="p-6 space-y-4">
                <input type="hidden" id="taskId">
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1.5">Task Title *</label>
                    <input type="text" id="taskTitle" required placeholder="e.g., Redesign landing page header..." class="w-full input-glass rounded-xl px-4 py-2.5 text-sm text-slate-200 placeholder-slate-600 focus:outline-none transition-all">
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-400 mb-1.5">Description</label>
                    <textarea id="taskDesc" rows="3" placeholder="Add extra context, checklists, or specifications..." class="w-full input-glass rounded-xl px-4 py-2.5 text-sm text-slate-200 placeholder-slate-600 focus:outline-none transition-all resize-none"></textarea>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5">Priority Level</label>
                        <select id="taskPriority" class="w-full input-glass rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none transition-all">
                            <option value="Low">Low Priority</option>
                            <option value="Medium" selected>Medium Priority</option>
                            <option value="High">High Priority</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-400 mb-1.5">Due Date *</label>
                        <input type="date" id="taskDueDate" required class="w-full input-glass rounded-xl px-4 py-2.5 text-sm text-slate-200 focus:outline-none transition-all">
                    </div>
                </div>
                <div class="pt-4 border-t border-white/10 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeModal()" class="px-5 py-2.5 rounded-xl glass text-slate-300 hover:text-white font-medium text-sm transition-all">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl glass-strong hover:bg-white/10 text-white font-medium text-sm transition-all">Save Task</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Application Logic Script -->
    <script>
        // Task store — starts empty; no seeded sample data
        let tasks = [];

        let currentFilter = 'all';
        let currentView = 'table';
        let currentSearchQuery = '';

        // Initialize App on Window Load
        window.onload = function() {
            // Set today's date as minimum on date picker
            const todayStr = new Date().toISOString().split('T')[0];
            document.getElementById('taskDueDate').min = todayStr;
            renderApp();
        };

        // Render application components
        function renderApp() {
            updateStats();
            renderTaskList();
            updateSidebarCounts();
        }

        // Update statistics cards
        function updateStats() {
            const total = tasks.length;
            const pending = tasks.filter(t => t.status === 'pending').length;
            const completed = tasks.filter(t => t.status === 'completed').length;

            document.getElementById('statTotal').innerText = total;
            document.getElementById('statPending').innerText = pending;
            document.getElementById('statCompleted').innerText = completed;
        }

        // Update sidebar badges count
        function updateSidebarCounts() {
            document.getElementById('count-all').innerText = tasks.length;
            document.getElementById('count-pending').innerText = tasks.filter(t => t.status === 'pending').length;
            document.getElementById('count-completed').innerText = tasks.filter(t => t.status === 'completed').length;
        }

        // Filter handler from sidebar
        function filterTasks(filter) {
            currentFilter = filter;

            // Highlight active sidebar link
            ['all', 'pending', 'completed'].forEach(f => {
                const el = document.getElementById(`nav-${f}`);
                if (f === filter) {
                    el.className = "flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium glass-strong text-white transition-all";
                } else {
                    el.className = "flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-400 hover:text-white glass-hover border border-transparent transition-all";
                }
            });

            // Update badge title
            const badgeNames = { all: 'All Tasks', pending: 'Pending Tasks', completed: 'Completed Tasks' };
            document.getElementById('currentFilterBadge').innerText = badgeNames[filter];

            renderTaskList();
        }

        // Search handler
        function handleSearch() {
            currentSearchQuery = document.getElementById('searchInput').value.toLowerCase().trim();
            renderTaskList();
        }

        // Priority filter change
        function applyFilters() {
            renderTaskList();
        }

        // Switch between table and grid views
        function setViewMode(mode) {
            currentView = mode;
            const btnTable = document.getElementById('btnViewTable');
            const btnGrid = document.getElementById('btnViewGrid');
            const tableContainer = document.getElementById('tableViewContainer');
            const gridContainer = document.getElementById('gridViewContainer');

            if (mode === 'table') {
                btnTable.className = "p-1.5 rounded-lg text-white glass-strong transition-all text-xs px-2.5 font-medium flex items-center gap-1.5";
                btnGrid.className = "p-1.5 rounded-lg text-slate-400 hover:text-white transition-all text-xs px-2.5 font-medium flex items-center gap-1.5";
                tableContainer.classList.remove('hidden');
                gridContainer.classList.add('hidden');
            } else {
                btnGrid.className = "p-1.5 rounded-lg text-white glass-strong transition-all text-xs px-2.5 font-medium flex items-center gap-1.5";
                btnTable.className = "p-1.5 rounded-lg text-slate-400 hover:text-white transition-all text-xs px-2.5 font-medium flex items-center gap-1.5";
                gridContainer.classList.remove('hidden');
                tableContainer.classList.add('hidden');
            }
            renderTaskList();
        }

        // Core filtered list generator
        function getFilteredTasks() {
            const priorityVal = document.getElementById('priorityFilter').value;

            return tasks.filter(task => {
                // Status Filter
                if (currentFilter !== 'all' && task.status !== currentFilter) return false;
                // Priority Filter
                if (priorityVal !== 'all' && task.priority !== priorityVal) return false;
                // Search Query
                if (currentSearchQuery && !task.title.toLowerCase().includes(currentSearchQuery) && !task.description.toLowerCase().includes(currentSearchQuery)) return false;
                return true;
            });
        }

        // Render main task list items (Table & Grid)
        function renderTaskList() {
            const filtered = getFilteredTasks();
            const tableBody = document.getElementById('taskTableBody');
            const gridContainer = document.getElementById('gridViewContainer');
            const emptyState = document.getElementById('emptyState');

            tableBody.innerHTML = '';
            gridContainer.innerHTML = '';

            if (filtered.length === 0) {
                emptyState.classList.remove('hidden');
                return;
            } else {
                emptyState.classList.add('hidden');
            }

            filtered.forEach(task => {
                // Priority badge styling
                let priorityClass = 'bg-white/5 text-slate-300 border-white/10';
                if (task.priority === 'High') priorityClass = 'bg-rose-400/10 text-rose-300 border-rose-400/20';
                if (task.priority === 'Medium') priorityClass = 'bg-amber-400/10 text-amber-300 border-amber-400/20';
                if (task.priority === 'Low') priorityClass = 'bg-emerald-400/10 text-emerald-300 border-emerald-400/20';

                // Status badge styling
                const isCompleted = task.status === 'completed';
                const statusBadge = isCompleted
                    ? `<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-400/10 text-emerald-300 border border-emerald-400/20"><i class="fa-solid fa-check text-[10px]"></i> Completed</span>`
                    : `<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-amber-400/10 text-amber-300 border border-amber-400/20"><i class="fa-solid fa-clock text-[10px]"></i> Pending</span>`;

                // Render Table Row
                const tr = document.createElement('tr');
                tr.className = "hover:bg-white/[0.03] transition-colors group";
                tr.innerHTML = `
                    <td class="py-4 px-6">
                        <div class="font-medium text-white ${isCompleted ? 'line-through text-slate-500' : ''}">${escapeHtml(task.title)}</div>
                        <div class="text-xs text-slate-500 mt-0.5 line-clamp-1">${escapeHtml(task.description || 'No description provided.')}</div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium border ${priorityClass}">${task.priority}</span>
                    </td>
                    <td class="py-4 px-6 text-xs text-slate-400">
                        <div class="flex items-center gap-1.5"><i class="fa-regular fa-calendar text-slate-500"></i> ${task.dueDate}</div>
                    </td>
                    <td class="py-4 px-6">
                        ${statusBadge}
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="toggleTaskStatus('${task.id}')" title="Toggle Status" class="w-8 h-8 rounded-lg glass text-slate-300 hover:text-emerald-300 flex items-center justify-center transition-all">
                                <i class="fa-solid ${isCompleted ? 'fa-rotate-left' : 'fa-check'} text-xs"></i>
                            </button>
                            <button onclick="openEditModal('${task.id}')" title="Edit Task" class="w-8 h-8 rounded-lg glass text-slate-300 hover:text-accent flex items-center justify-center transition-all">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </button>
                            <button onclick="deleteTask('${task.id}')" title="Delete Task" class="w-8 h-8 rounded-lg glass text-slate-300 hover:text-rose-300 flex items-center justify-center transition-all">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </div>
                    </td>
                `;
                tableBody.appendChild(tr);

                // Render Grid Card
                const card = document.createElement('div');
                card.className = "glass rounded-2xl p-5 flex flex-col justify-between glass-hover transition-all";
                card.innerHTML = `
                    <div>
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium border ${priorityClass}">${task.priority}</span>
                            ${statusBadge}
                        </div>
                        <h4 class="font-medium text-white text-base mb-1.5 ${isCompleted ? 'line-through text-slate-500' : ''}">${escapeHtml(task.title)}</h4>
                        <p class="text-xs text-slate-500 line-clamp-2 mb-4">${escapeHtml(task.description || 'No description provided.')}</p>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5 text-xs text-slate-500 mb-4 pt-3 border-t border-white/10">
                            <i class="fa-regular fa-calendar text-slate-500"></i> Due: ${task.dueDate}
                        </div>
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="toggleTaskStatus('${task.id}')" class="flex-1 py-2 px-3 rounded-xl glass hover:bg-white/10 text-xs font-medium text-slate-200 flex items-center justify-center gap-1.5 transition-all">
                                <i class="fa-solid ${isCompleted ? 'fa-rotate-left' : 'fa-check'} text-xs"></i> ${isCompleted ? 'Reopen' : 'Complete'}
                            </button>
                            <button onclick="openEditModal('${task.id}')" class="w-9 h-9 rounded-xl glass text-slate-300 hover:text-accent flex items-center justify-center transition-all">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </button>
                            <button onclick="deleteTask('${task.id}')" class="w-9 h-9 rounded-xl glass text-slate-300 hover:text-rose-300 flex items-center justify-center transition-all">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </div>
                    </div>
                `;
                gridContainer.appendChild(card);
            });
        }

        // Modal Controls
        function openModal() {
            document.getElementById('taskId').value = '';
            document.getElementById('taskForm').reset();
            document.getElementById('modalTitle').innerHTML = '<i class="fa-solid fa-circle-plus text-accent"></i> Create New Task';

            const modal = document.getElementById('taskModal');
            const card = document.getElementById('modalCard');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                card.classList.remove('scale-95');
                card.classList.add('scale-100');
            }, 10);
        }

        function openEditModal(id) {
            const task = tasks.find(t => t.id === id);
            if (!task) return;

            document.getElementById('taskId').value = task.id;
            document.getElementById('taskTitle').value = task.title;
            document.getElementById('taskDesc').value = task.description;
            document.getElementById('taskPriority').value = task.priority;
            document.getElementById('taskDueDate').value = task.dueDate;
            document.getElementById('modalTitle').innerHTML = '<i class="fa-solid fa-pen-to-square text-accent"></i> Edit Task Item';

            const modal = document.getElementById('taskModal');
            const card = document.getElementById('modalCard');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                card.classList.remove('scale-95');
                card.classList.add('scale-100');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('taskModal');
            const card = document.getElementById('modalCard');
            modal.classList.add('opacity-0');
            card.classList.remove('scale-100');
            card.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        // Form Submission handler (Create or Update)
        function handleFormSubmit(event) {
            event.preventDefault();
            const id = document.getElementById('taskId').value;
            const title = document.getElementById('taskTitle').value.trim();
            const description = document.getElementById('taskDesc').value.trim();
            const priority = document.getElementById('taskPriority').value;
            const dueDate = document.getElementById('taskDueDate').value;

            if (!title || !dueDate) return;

            if (id) {
                // Update existing
                tasks = tasks.map(t => t.id === id ? { ...t, title, description, priority, dueDate } : t);
                showFlash('Task successfully updated!', 'success');
            } else {
                // Create new
                const newTask = {
                    id: Date.now().toString(),
                    title,
                    description,
                    priority,
                    dueDate,
                    status: 'pending'
                };
                tasks.unshift(newTask);
                showFlash('New task created successfully!', 'success');
            }

            closeModal();
            renderApp();
        }

        // Toggle task completion status
        function toggleTaskStatus(id) {
            tasks = tasks.map(t => {
                if (t.id === id) {
                    const newStatus = t.status === 'completed' ? 'pending' : 'completed';
                    showFlash(`Task marked as ${newStatus}!`, 'success');
                    return { ...t, status: newStatus };
                }
                return t;
            });
            renderApp();
        }

        // Delete task
        function deleteTask(id) {
            if (confirm('Are you sure you want to remove this task?')) {
                tasks = tasks.filter(t => t.id !== id);
                showFlash('Task deleted successfully.', 'error');
                renderApp();
            }
        }

        // Flash message notification banner
        function showFlash(message, type) {
            const flash = document.getElementById('flashMessage');
            const text = document.getElementById('flashText');
            const icon = document.getElementById('flashIcon');

            text.innerText = message;
            if (type === 'success') {
                flash.className = "mx-6 md:mx-10 mt-6 p-4 rounded-xl glass text-emerald-300 flex items-center gap-3 text-sm transition-all duration-300";
                icon.className = "fa-solid fa-circle-check text-base text-emerald-300";
            } else {
                flash.className = "mx-6 md:mx-10 mt-6 p-4 rounded-xl glass text-rose-300 flex items-center gap-3 text-sm transition-all duration-300";
                icon.className = "fa-solid fa-circle-exclamation text-base text-rose-300";
            }

            flash.classList.remove('hidden');
            setTimeout(() => {
                flash.classList.add('hidden');
            }, 3500);
        }

        // HTML Sanitizer helper
        function escapeHtml(str) {
            return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }
    </script>
</body>
</html>