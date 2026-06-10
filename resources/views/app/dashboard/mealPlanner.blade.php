@extends('layouts.app', [
    'title' => $title,
    'active' => $active,
    'showSearch' => false,
    'topbarTitle' => $topbarTitle,
])

@section('content')

    <div class="page-header">
        <div class="breadcrumb">
          <a href="{{ route('dashboard') }}">Home</a><span class="sep">›</span> Meal Planner
        </div>
        <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px;">
          <div>
            <h2>Weekly Meal Planner 📅</h2>
            <p>Drag &amp; drop recipes into your week. Grocery list auto-generates from your plan.</p>
          </div>
          <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <button class="btn btn-outline btn-sm" onclick="prevWeek()">← Prev Week</button>
            <button class="btn btn-ghost btn-sm" id="weekLabel" onclick="goToToday()">This Week</button>
            <button class="btn btn-outline btn-sm" onclick="nextWeek()">Next Week →</button>
            <a href="{{ route('grocery-list') }}" class="btn btn-secondary">🛒 Generate Grocery List</a>
            <button class="btn btn-primary" onclick="clearWeek()">🗑️ Clear Week</button>
          </div>
        </div>
    </div>

    <!-- Nutrition Summary -->
    <div class="grid-4 mb-6" id="nutritionSummary">
    <div class="stat-card">
        <div class="stat-icon green">🔥</div>
        <div class="stat-info">
        <div class="value" id="totalKcal">7,020</div>
        <div class="label">Weekly Calories</div>
        <div class="change">Avg 1,003/day</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">🍽️</div>
        <div class="stat-info">
        <div class="value" id="totalMeals">9</div>
        <div class="label">Meals Planned</div>
        <div class="change">of 21 total</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">🛒</div>
        <div class="stat-info">
        <div class="value" id="uniqueIngredients">34</div>
        <div class="label">Ingredients Needed</div>
        <div class="change">Grocery list ready</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow">💰</div>
        <div class="stat-info">
        <div class="value">£42</div>
        <div class="label">Est. Cost</div>
        <div class="change">~£6/day</div>
        </div>
    </div>
    </div>

    <!-- Week view with overflow -->
    <div class="card mb-6" style="overflow-x:auto;">
    <div class="card-header">
        <h4>📅 Week of <span id="weekRange">5–11 May 2025</span></h4>
        <div style="display:flex;gap:8px;">
        <button class="btn btn-ghost btn-sm" onclick="printPlanner()">🖨️ Print</button>
        <button class="btn btn-ghost btn-sm" onclick="exportPlanner()">⬇️ Export</button>
        </div>
    </div>
    <div class="planner-grid" id="plannerGrid" style="min-width:700px;">
        <!-- JS renders this -->
    </div>
    </div>

    <!-- Recipe Suggestions Panel -->
    <div class="card">
    <div class="card-header">
        <h4>🍽️ Quick Add Recipes</h4>
        <div style="display:flex;gap:8px;align-items:center;">
        <select class="form-control" style="width:auto;padding:6px 10px;font-size:.82rem;" id="catFilter" onchange="renderSuggestionPanel()">
            <option value="all">All Categories</option>
        </select>
        <a href="{{ route('browse-recipes') }}" class="btn btn-outline btn-sm">Browse All →</a>
        </div>
    </div>
    <div class="card-body">
        <p style="font-size:.85rem;margin-bottom:12px;color:var(--text-secondary);">Click a recipe to add it to your planner. Select a day &amp; meal time in the modal.</p>
        <div class="grid-4" id="suggestionPanel"></div>
    </div>
    </div>

@endsection

@section("modals")
    <!-- ===== Add to Planner Modal ===== -->
    <div class="modal-overlay" id="addModal">
    <div class="modal">
        <div class="modal-header">
        <h3>📅 Add to Planner</h3>
        <button class="modal-close" onclick="closeModal()">✕</button>
        </div>
        <div class="modal-body">
        <p style="margin-bottom:16px;" id="addModalRecipeName">Recipe Name</p>
        <div class="form-group">
            <label class="form-label">Select Day</label>
            <div style="display:grid;grid-template-columns:repeat(7,1fr);gap:6px;" id="dayPicker"></div>
        </div>
        <div class="form-group">
            <label class="form-label">Meal Time</label>
            <div style="display:flex;gap:10px;">
            <label class="diet-chip" style="flex:1;justify-content:center;"><input type="radio" name="mealTime" value="breakfast" style="display:none;"/> 🌅 Breakfast</label>
            <label class="diet-chip" style="flex:1;justify-content:center;"><input type="radio" name="mealTime" value="lunch"     style="display:none;"/> ☀️ Lunch</label>
            <label class="diet-chip" style="flex:1;justify-content:center;"><input type="radio" name="mealTime" value="dinner"    style="display:none;"/> 🌙 Dinner</label>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Servings</label>
            <input type="number" class="form-control" id="servingsInput" value="2" min="1" max="20" />
        </div>
        <div class="form-group">
            <label class="form-label">Select Recipe</label>
            <input
                type="text"
                class="form-control"
                id="modalRecipeSearch"
                placeholder="Search recipe name..."
                oninput="renderSuggestionInModal()"
            />
            <div id="modalRecipeList" style="display:grid;gap:8px;margin-top:10px;max-height:220px;overflow-y:auto;"></div>
        </div>
        </div>
        <div class="modal-footer">
        <button class="btn btn-ghost" onclick="closeModal()">Cancel</button>
        <button class="btn btn-primary" onclick="confirmAdd()">Add to Planner ✓</button>
        </div>
    </div>
    </div>

    <!-- Toast -->
    <div class="toast-container" id="toastContainer"></div>

    <style>
        .diet-chip { cursor: pointer; }
        .diet-chip:has(input:checked) { background: var(--primary); border-color: var(--primary); color: #fff; }
        .day-btn {
        padding: 6px 4px;
        border-radius: var(--radius-sm);
        border: 1.5px solid var(--border);
        font-size: .75rem;
        font-weight: 700;
        cursor: pointer;
        text-align: center;
        transition: var(--transition);
        background: var(--bg-card);
        }
        .day-btn:hover { border-color: var(--primary); color: var(--primary); }
        .day-btn.selected { background: var(--primary); color: #fff; border-color: var(--primary); }
        .suggestions-dropdown {
        position: absolute;
        top: 44px; left: 0;
        width: 100%;
        background: var(--bg-card);
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border);
        z-index: 100;
        max-height: 240px;
        overflow-y: auto;
        }
        .suggestion-item {
        padding: 10px 14px;
        cursor: pointer;
        font-size: .88rem;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: var(--transition);
        }
        .suggestion-item:hover { background: var(--border-light); }
        .quick-recipe-card {
        background: var(--border-light);
        border-radius: var(--radius-sm);
        padding: 12px;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1.5px solid transparent;
        }
        .quick-recipe-card:hover { border-color: var(--primary); background: #F0FFF4; }
        .quick-recipe-card .qr-emoji { font-size: 1.8rem; flex-shrink: 0; }
        .quick-recipe-card .qr-info .qr-title { font-weight: 700; font-size: .85rem; }
        .quick-recipe-card .qr-info .qr-meta { font-size: .75rem; color: var(--text-secondary); }
        .modal-recipe-item {
        width: 100%;
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        background: var(--bg-card);
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        cursor: pointer;
        transition: var(--transition);
        }
        .modal-recipe-item:hover { border-color: var(--primary); }
        .modal-recipe-item.is-selected {
        border-color: var(--primary);
        background: #F0FFF4;
        }
        .modal-recipe-main {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
        }
        .modal-recipe-title {
        font-weight: 700;
        font-size: .85rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        }
        .modal-recipe-meta { font-size: .75rem; color: var(--text-secondary); }
    </style>
@endsection

@push('scripts')
    <script>
    const MEAL_PLANNER_RECIPES_URL = '{{ route('browse-recipes.api') }}';
    const MEAL_PLANNER_WEEK_URL = '{{ route('meal-planner.api') }}';
    const MEAL_PLANNER_SAVE_URL = '{{ route('meal-planner.save') }}';
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const DAYS = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
    const MEALS = ['breakfast','lunch','dinner'];
    let RECIPES = [];

    // Planner state: { 'Mon-breakfast': {recipeId, servings}, ... }
    let plannerData = {};

    let selectedRecipeId = null;
    let selectedDay = null;
    let weekOffset = 0;
    let savePlannerTimer = null;

    function escapeHtml(value) {
        return String(value ?? '').replaceAll('&', '&amp;').replaceAll('<', '&lt;').replaceAll('>', '&gt;').replaceAll('"', '&quot;').replaceAll("'", '&#039;');
    }

    function normalizeLabel(value) {
        return String(value || '').replace(/[_-]/g, ' ').replace(/\b\w/g, character => character.toUpperCase());
    }

    function formatMinutes(value) {
        if (!value || Number(value) <= 0) {
            return 'N/A';
        }

        const total = Number(value);
        const hours = Math.floor(total / 60);
        const minutes = total % 60;

        if (hours > 0 && minutes > 0) {
            return `${hours}h ${minutes}m`;
        }

        if (hours > 0) {
            return `${hours}h`;
        }

        return `${minutes}m`;
    }

    function recipeEmoji(category) {
        const map = {
            breakfast: '🍳',
            lunch: '🥗',
            dinner: '🍽️',
            dessert: '🍰',
            soup: '🍲',
            vegetarian: '🥦',
            vegan: '🌱',
            'main course': '🍗',
        };

        return map[String(category || '').toLowerCase()] || '🍽️';
    }

    function mapRecipeFromApi(recipe) {
        const category = String(recipe.category || 'all').toLowerCase();
        const ingredients = []
            .concat(Array.isArray(recipe.dish_types) ? recipe.dish_types : [])
            .concat(Array.isArray(recipe.diets) ? recipe.diets : [])
            .map(item => String(item || '').trim())
            .filter(Boolean);

        return {
            id: String(recipe.id),
            emoji: recipeEmoji(category),
            cat: category,
            title: String(recipe.title || 'Untitled recipe'),
            time: formatMinutes(recipe.ready_in_minutes),
            kcal: recipe.calories ? Number(recipe.calories) : 0,
            ingredients: ingredients.length ? ingredients : [String(recipe.title || 'Recipe')],
        };
    }

    function populateCategoryFilter() {
        const select = document.getElementById('catFilter');
        if (!select) {
            return;
        }

        const categories = Array.from(new Set(RECIPES.map(recipe => recipe.cat).filter(category => category && category !== 'all'))).sort();
        const currentValue = select.value || 'all';

        select.innerHTML = [
            '<option value="all">All Categories</option>',
            ...categories.map(category => `<option value="${escapeHtml(category)}">${escapeHtml(normalizeLabel(category))}</option>`),
        ].join('');

        select.value = categories.includes(currentValue) || currentValue === 'all' ? currentValue : 'all';
    }

    async function fetchPlannerRecipes() {
        const params = new URLSearchParams({
            per_page: '50',
        });

        const response = await fetch(`${MEAL_PLANNER_RECIPES_URL}?${params.toString()}`, {
            headers: { Accept: 'application/json' },
        });

        if (!response.ok) {
            throw new Error('Could not load meal planner recipes.');
        }

        const payload = await response.json();
        const data = Array.isArray(payload.data) ? payload.data : [];
        RECIPES = data.map(mapRecipeFromApi);

        populateCategoryFilter();
    }

    function getWeekStartDate() {
        const now = new Date();
        const day = now.getDay() || 7;
        const monday = new Date(now);
        monday.setDate(now.getDate() - day + 1 + weekOffset * 7);
        monday.setHours(0, 0, 0, 0);

        return monday;
    }

    function getWeekStartIso() {
        const monday = getWeekStartDate();
        const year = monday.getFullYear();
        const month = String(monday.getMonth() + 1).padStart(2, '0');
        const day = String(monday.getDate()).padStart(2, '0');

        return `${year}-${month}-${day}`;
    }

    function normalizePlannerData(data) {
        if (!data || typeof data !== 'object') {
            return {};
        }

        const normalized = {};

        Object.entries(data).forEach(([slotKey, value]) => {
            if (!value || typeof value !== 'object') {
                return;
            }

            const recipeId = String(value.recipeId ?? value.recipe_id ?? '').trim();
            const servings = Math.max(parseInt(value.servings, 10) || 1, 1);

            if (recipeId === '') {
                return;
            }

            normalized[slotKey] = {
                recipeId,
                servings,
            };
        });

        return normalized;
    }

    async function loadWeeklyPlanner() {
        const weekStart = getWeekStartIso();
        const params = new URLSearchParams({ week_start: weekStart });

        const response = await fetch(`${MEAL_PLANNER_WEEK_URL}?${params.toString()}`, {
            headers: { Accept: 'application/json' },
        });

        if (!response.ok) {
            throw new Error('Could not load weekly planner.');
        }

        const payload = await response.json();
        const plannerPayload = normalizePlannerData(payload?.data?.planner_data ?? null);

        if (Object.keys(plannerPayload).length > 0) {
            plannerData = plannerPayload;
        } else {
            plannerData = {};
        }

        renderPlanner();
        renderSuggestionPanel();
    }

    async function saveWeeklyPlanner() {
        const response = await fetch(MEAL_PLANNER_SAVE_URL, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
            },
            body: JSON.stringify({
                week_start: getWeekStartIso(),
                planner_data: plannerData,
            }),
        });

        if (!response.ok) {
            throw new Error('Could not save weekly planner.');
        }
    }

    function queueSaveWeeklyPlanner() {
        if (savePlannerTimer !== null) {
            clearTimeout(savePlannerTimer);
        }

        savePlannerTimer = setTimeout(() => {
            saveWeeklyPlanner().catch(error => {
                console.error(error);
                showToast('Could not save this week plan right now.', 'error');
            });
        }, 300);
    }

    function getWeekDates() {
        const monday = getWeekStartDate();
        return DAYS.map((d, i) => {
        const dt = new Date(monday);
        dt.setDate(monday.getDate() + i);
        return {
            label: d,
            date: dt.getDate(),
            month: dt.toLocaleString('default', { month: 'short' }),
            year: dt.getFullYear(),
        };
        });
    }

    function renderPlanner() {
        const dates = getWeekDates();
        const start = dates[0];
        const end = dates[6];
        const weekRange = start.year === end.year
        ? `${start.date} ${start.month} - ${end.date} ${end.month} ${start.year}`
        : `${start.date} ${start.month} ${start.year} - ${end.date} ${end.month} ${end.year}`;

        document.getElementById('weekRange').textContent = weekRange;
        const grid = document.getElementById('plannerGrid');

        let html = `<div class="planner-cell planner-header" style="background:var(--bg-sidebar);">Meal</div>`;
        dates.forEach(d => { html += `<div class="planner-cell planner-header">${d.label}<br><small style="font-weight:400;opacity:.7;">${d.date} ${d.month}</small></div>`; });

        MEALS.forEach(meal => {
        const icon = meal === 'breakfast' ? '🌅' : meal === 'lunch' ? '☀️' : '🌙';
        html += `<div class="planner-cell planner-row-label">${icon}<br>${meal.charAt(0).toUpperCase() + meal.slice(1)}</div>`;
        DAYS.forEach(day => {
            const key = `${day}-${meal}`;
            const entry = plannerData[key];
            const recipe = entry ? RECIPES.find(r => r.id === entry.recipeId) : null;
            html += `<div class="planner-cell planner-slot ${entry ? 'has-meal' : ''}" onclick="openAddModal('${day}', '${meal}')">`;
            if (recipe) {
            html += `<div class="meal-chip">${recipe.emoji} ${escapeHtml(recipe.title.split(' ').slice(0,2).join(' '))}<span class="remove" onclick="event.stopPropagation();removeMeal('${key}')">✕</span></div>`;
            html += `<div style="font-size:.68rem;color:var(--primary);margin-top:2px;">🔥 ${escapeHtml(recipe.kcal || 'N/A')} kcal × ${entry.servings}</div>`;
            } else {
            html += `<button class="add-meal-btn">+ Add</button>`;
            }
            html += `</div>`;
        });
        });

        grid.innerHTML = html;
        updateStats();
    }

    function updateStats() {
        let total = 0, meals = 0, allIngredients = new Set();
        Object.entries(plannerData).forEach(([key, entry]) => {
        const r = RECIPES.find(x => x.id === entry.recipeId);
        if (r) { total += Number(r.kcal || 0) * entry.servings; meals++; (r.ingredients || []).forEach(i => allIngredients.add(i)); }
        });
        document.getElementById('totalKcal').textContent = total.toLocaleString();
        document.getElementById('totalMeals').textContent = meals;
        document.getElementById('uniqueIngredients').textContent = allIngredients.size;
    }

    function openAddModal(day, meal, preselectedRecipeId = null) {
        selectedRecipeId = preselectedRecipeId;
        selectedDay = day;
        document.getElementById('addModal').classList.add('active');
        document.getElementById('addModalRecipeName').textContent = `Select a recipe for ${day} ${meal.charAt(0).toUpperCase()+meal.slice(1)}`;

        const picker = document.getElementById('dayPicker');
        picker.innerHTML = DAYS.map(d => `<button class="day-btn${d===day?' selected':''}" onclick="selectDay('${d}', this)">${d}</button>`).join('');

        const mealRadio = document.querySelector(`input[name="mealTime"][value="${meal}"]`);
        if (mealRadio) mealRadio.checked = true;

        renderSuggestionInModal();
    }

    function selectDay(d, el) {
        selectedDay = d;
        document.querySelectorAll('.day-btn').forEach(b => b.classList.remove('selected'));
        el.classList.add('selected');
    }

    function renderSuggestionInModal() {
        const container = document.getElementById('modalRecipeList');
        const input = document.getElementById('modalRecipeSearch');

        if (!container || !input) {
            return;
        }

        const searchTerm = String(input.value || '').trim().toLowerCase();
        const filteredRecipes = searchTerm === ''
            ? RECIPES
            : RECIPES.filter(recipe => recipe.title.toLowerCase().includes(searchTerm));

        if (filteredRecipes.length === 0) {
            container.innerHTML = '<div class="suggestion-item">No recipes found</div>';

            return;
        }

        container.innerHTML = filteredRecipes.map(recipe => {
            const selectedClass = selectedRecipeId === recipe.id ? 'is-selected' : '';
            const selectedBadge = selectedRecipeId === recipe.id ? '✓ Selected' : 'Select';

            return `
                <button type="button" class="modal-recipe-item ${selectedClass}" data-recipe-id="${escapeHtml(recipe.id)}" onclick="selectRecipeForModal(this.dataset.recipeId)">
                    <span class="modal-recipe-main">
                        <span class="qr-emoji">${recipe.emoji}</span>
                        <span>
                            <span class="modal-recipe-title">${escapeHtml(recipe.title)}</span>
                            <span class="modal-recipe-meta">⏱️ ${escapeHtml(recipe.time)} · 🔥 ${escapeHtml(recipe.kcal || 'N/A')} kcal</span>
                        </span>
                    </span>
                    <span class="badge badge-primary">${selectedBadge}</span>
                </button>
            `;
        }).join('');
    }

    function selectRecipeForModal(recipeId) {
        selectedRecipeId = recipeId;
        renderSuggestionInModal();

        const recipe = RECIPES.find(item => item.id === recipeId);
        if (recipe) {
            document.getElementById('addModalRecipeName').textContent = `Adding: ${recipe.emoji} ${recipe.title}`;
        }
    }

    function confirmAdd() {
        if (!selectedRecipeId) { showToast('⚠️ Please select a recipe below first', 'error'); return; }
        const meal = document.querySelector('input[name="mealTime"]:checked');
        if (!meal) { showToast('⚠️ Please select a meal time', 'error'); return; }
        const servings = parseInt(document.getElementById('servingsInput').value) || 2;
        const key = `${selectedDay}-${meal.value}`;
        plannerData[key] = { recipeId: selectedRecipeId, servings };
        renderPlanner();
        queueSaveWeeklyPlanner();
        closeModal();
        showToast('✅ Meal added to planner!', 'success');
        selectedRecipeId = null;
    }

    function removeMeal(key) {
        delete plannerData[key];
        renderPlanner();
        queueSaveWeeklyPlanner();
        showToast('🗑️ Meal removed', '');
    }

    function clearWeek() {
        if (confirm('Clear all meals for this week?')) {
        plannerData = {};
        renderPlanner();
        queueSaveWeeklyPlanner();
        showToast('🗑️ Week cleared', '');
        }
    }

    function closeModal() { document.getElementById('addModal').classList.remove('active'); }
    document.getElementById('addModal').addEventListener('click', e => { if (e.target === document.getElementById('addModal')) closeModal(); });

    function renderSuggestionPanel() {
        const cat = document.getElementById('catFilter').value;
        const recipes = cat === 'all' ? RECIPES : RECIPES.filter(r => r.cat === cat);
        const quickAddRecipes = recipes.slice(0, 12);

        if (quickAddRecipes.length === 0) {
            document.getElementById('suggestionPanel').innerHTML = '<div class="empty-state" style="grid-column:1/-1"><div class="empty-icon">🍽️</div><h4>No recipes available</h4><p>Try another category or add recipes in Browse Recipes first.</p></div>';

            return;
        }

        document.getElementById('suggestionPanel').innerHTML = quickAddRecipes.map(r => `
        <div class="quick-recipe-card" data-recipe-id="${escapeHtml(r.id)}" onclick="quickAddRecipe(this.dataset.recipeId)">
            <span class="qr-emoji">${r.emoji}</span>
            <div class="qr-info">
            <div class="qr-title">${escapeHtml(r.title)}</div>
            <div class="qr-meta">⏱️ ${escapeHtml(r.time)} · 🔥 ${escapeHtml(r.kcal || 'N/A')} kcal</div>
            </div>
        </div>
        `).join('');
    }

    function quickAddRecipe(id) {
        const r = RECIPES.find(x => x.id === id);
        if (!r) {
            showToast('Recipe could not be loaded.', 'error');

            return;
        }

        openAddModal(selectedDay || 'Mon', 'dinner', id);
        document.getElementById('addModalRecipeName').textContent = `Adding: ${r.emoji} ${r.title}`;
    }

    function maybeOpenModalFromQuery() {
        const params = new URLSearchParams(window.location.search);
        const recipeId = String(params.get('recipe_id') || '').trim();

        if (recipeId === '') {
            return;
        }

        const recipe = RECIPES.find(item => item.id === recipeId);
        if (!recipe) {
            showToast('Recipe could not be loaded into planner.', 'error');

            return;
        }

        openAddModal(selectedDay || 'Mon', 'dinner', recipeId);
        document.getElementById('addModalRecipeName').textContent = `Adding: ${recipe.emoji} ${recipe.title}`;

        params.delete('recipe_id');
        params.delete('from');
        const query = params.toString();
        const cleanUrl = `${window.location.pathname}${query ? `?${query}` : ''}`;
        window.history.replaceState({}, '', cleanUrl);
    }

    function prevWeek()  { weekOffset--; loadWeeklyPlanner().catch(error => { console.error(error); showToast('Could not load previous week.', 'error'); }); }
    function nextWeek()  { weekOffset++; loadWeeklyPlanner().catch(error => { console.error(error); showToast('Could not load next week.', 'error'); }); }
    function goToToday() { weekOffset = 0; loadWeeklyPlanner().catch(error => { console.error(error); showToast('Could not load current week.', 'error'); }); }
    function printPlanner()  { window.print(); }
    function exportPlanner() { showToast('📥 Planner exported!', 'success'); }

    function toggleSidebar() { document.getElementById('sidebar').classList.toggle('open'); }

    function showToast(msg, type = '') {
        const c = document.getElementById('toastContainer');
        const t = document.createElement('div');
        t.className = `toast ${type}`;
        t.textContent = msg;
        c.appendChild(t);
        setTimeout(() => t.remove(), 3000);
    }

        // Init
        fetchPlannerRecipes()
            .then(() => loadWeeklyPlanner())
            .then(() => maybeOpenModalFromQuery())
            .catch(error => {
                console.error(error);
                plannerData = {};
                renderPlanner();
                renderSuggestionPanel();
                showToast('Could not load planner data right now.', 'error');
            });
    </script>
@endpush
