@extends('layouts.app', [
    'title' => $title,
    'active' => $active,
    'showSearch' => false,
    'topbarTitle' => $topbarTitle,
])

@section('content')

    <div class="page-header">
        <div class="breadcrumb">
          <a href="dashboard.html">Home</a><span class="sep">›</span> Meal Planner
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
            <a href="grocery-list.html" class="btn btn-secondary">🛒 Generate Grocery List</a>
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
            <option value="chicken">Chicken</option>
            <option value="beef">Beef</option>
            <option value="pork">Pork</option>
            <option value="chinese">Chinese</option>
            <option value="fish">Fish</option>
            <option value="vegetarian">Vegetarian</option>
            <option value="vegan">Vegan</option>
            <option value="pasta">Pasta</option>
            <option value="indian">Indian</option>
            <option value="mexican">Mexican</option>
            <option value="dessert">Dessert</option>
            <option value="breakfast">Breakfast</option>
        </select>
        <a href="browse-recipes.html" class="btn btn-outline btn-sm">Browse All →</a>
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
    </style>
@endsection

@push('scripts')
<script>
  const DAYS = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
  const MEALS = ['breakfast','lunch','dinner'];

  const RECIPES = [
    {id:1, emoji:'🍗', cat:'chicken',    title:'Lemon Herb Roast Chicken',      time:'1h 20m', kcal:520, ingredients:['1 whole chicken (1.8kg)','2 lemons','4 garlic cloves','Thyme & rosemary','Olive oil','500g potatoes']},
    {id:2, emoji:'🥩', cat:'beef',       title:'Classic Beef Bolognese',        time:'45m',    kcal:680, ingredients:['500g beef mince','2 cans tomatoes','1 onion','2 garlic cloves','150ml red wine','Spaghetti']},
    {id:3, emoji:'🍜', cat:'chinese',    title:'Kung Pao Chicken Noodles',      time:'30m',    kcal:450, ingredients:['2 chicken breasts','200g noodles','3 tbsp soy sauce','Chilli flakes','50g peanuts','Spring onions']},
    {id:4, emoji:'🥓', cat:'pork',       title:'Slow Braised Pork Belly',       time:'3h',     kcal:720, ingredients:['1kg pork belly','4 tbsp soy sauce','2 tbsp honey','Star anise','Ginger, garlic','600ml chicken stock']},
    {id:5, emoji:'🐟', cat:'fish',       title:'Pan-Seared Salmon',             time:'20m',    kcal:380, ingredients:['2 salmon fillets','1 bunch asparagus','2 tbsp butter','1 lemon','Capers, dill','Olive oil']},
    {id:6, emoji:'🥦', cat:'vegetarian', title:'Mushroom & Spinach Risotto',    time:'35m',    kcal:420, ingredients:['300g arborio rice','400g mushrooms','100g spinach','1.2L veg stock','100ml white wine','80g parmesan']},
    {id:7, emoji:'🌱', cat:'vegan',      title:'Thai Green Curry (Vegan)',      time:'25m',    kcal:310, ingredients:['400ml coconut milk','2 tbsp curry paste','1 block tofu','1 aubergine','2 courgettes','Jasmine rice']},
    {id:8, emoji:'🍝', cat:'pasta',      title:'Creamy Carbonara',              time:'20m',    kcal:590, ingredients:['200g spaghetti','150g guanciale','3 egg yolks','50g pecorino','Black pepper']},
    {id:9, emoji:'🍛', cat:'indian',     title:'Butter Chicken',                time:'50m',    kcal:560, ingredients:['800g chicken thighs','400ml passata','200ml cream','2 tbsp butter','Garam masala','Basmati rice']},
    {id:10,emoji:'🌮', cat:'mexican',    title:'Street-Style Beef Tacos',       time:'25m',    kcal:490, ingredients:['400g skirt steak','Corn tortillas','Avocado','Pickled onions','Salsa verde','Lime']},
    {id:11,emoji:'🍳', cat:'breakfast',  title:'Full English Breakfast',        time:'20m',    kcal:750, ingredients:['4 rashers bacon','4 sausages','2 eggs','Baked beans','Mushrooms','Tomatoes','Toast']},
    {id:12,emoji:'🍗', cat:'chicken',    title:'Chicken Tikka Masala',          time:'45m',    kcal:510, ingredients:['700g chicken breast','Tikka marinade','400g passata','150ml cream','Onion, ginger','Basmati rice']},
  ];

  // Planner state: { 'Mon-breakfast': {recipeId, servings}, ... }
  let plannerData = {
    'Mon-breakfast': {recipeId:11, servings:2},
    'Mon-lunch':     {recipeId:6,  servings:2},
    'Mon-dinner':    {recipeId:1,  servings:4},
    'Wed-lunch':     {recipeId:8,  servings:2},
    'Wed-dinner':    {recipeId:2,  servings:4},
    'Thu-breakfast': {recipeId:11, servings:1},
    'Thu-dinner':    {recipeId:9,  servings:4},
    'Fri-lunch':     {recipeId:3,  servings:2},
    'Sat-dinner':    {recipeId:4,  servings:4},
  };

  let selectedRecipeId = null;
  let selectedDay = null;
  let weekOffset = 0;

  function getWeekDates() {
    const now = new Date();
    const day = now.getDay() || 7;
    const monday = new Date(now);
    monday.setDate(now.getDate() - day + 1 + weekOffset * 7);
    return DAYS.map((d, i) => {
      const dt = new Date(monday);
      dt.setDate(monday.getDate() + i);
      return { label: d, date: dt.getDate(), month: dt.toLocaleString('default', {month:'short'}) };
    });
  }

  function renderPlanner() {
    const dates = getWeekDates();
    document.getElementById('weekRange').textContent = `${dates[0].date} ${dates[0].month} – ${dates[6].date} ${dates[6].month} 2025`;
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
          html += `<div class="meal-chip">${recipe.emoji} ${recipe.title.split(' ').slice(0,2).join(' ')}<span class="remove" onclick="event.stopPropagation();removeMeal('${key}')">✕</span></div>`;
          html += `<div style="font-size:.68rem;color:var(--primary);margin-top:2px;">🔥 ${recipe.kcal} kcal × ${entry.servings}</div>`;
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
      if (r) { total += r.kcal * entry.servings; meals++; r.ingredients.forEach(i => allIngredients.add(i)); }
    });
    document.getElementById('totalKcal').textContent = total.toLocaleString();
    document.getElementById('totalMeals').textContent = meals;
    document.getElementById('uniqueIngredients').textContent = allIngredients.size;
  }

  function openAddModal(day, meal) {
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

  function renderSuggestionInModal() {}

  function confirmAdd() {
    if (!selectedRecipeId) { showToast('⚠️ Please select a recipe below first', 'error'); return; }
    const meal = document.querySelector('input[name="mealTime"]:checked');
    if (!meal) { showToast('⚠️ Please select a meal time', 'error'); return; }
    const servings = parseInt(document.getElementById('servingsInput').value) || 2;
    const key = `${selectedDay}-${meal.value}`;
    plannerData[key] = { recipeId: selectedRecipeId, servings };
    renderPlanner();
    closeModal();
    showToast('✅ Meal added to planner!', 'success');
    selectedRecipeId = null;
  }

  function removeMeal(key) {
    delete plannerData[key];
    renderPlanner();
    showToast('🗑️ Meal removed', '');
  }

  function clearWeek() {
    if (confirm('Clear all meals for this week?')) {
      plannerData = {};
      renderPlanner();
      showToast('🗑️ Week cleared', '');
    }
  }

  function closeModal() { document.getElementById('addModal').classList.remove('active'); }
  document.getElementById('addModal').addEventListener('click', e => { if (e.target === document.getElementById('addModal')) closeModal(); });

  function renderSuggestionPanel() {
    const cat = document.getElementById('catFilter').value;
    const recipes = cat === 'all' ? RECIPES : RECIPES.filter(r => r.cat === cat);
    document.getElementById('suggestionPanel').innerHTML = recipes.map(r => `
      <div class="quick-recipe-card" onclick="quickAddRecipe(${r.id})">
        <span class="qr-emoji">${r.emoji}</span>
        <div class="qr-info">
          <div class="qr-title">${r.title}</div>
          <div class="qr-meta">⏱️ ${r.time} · 🔥 ${r.kcal} kcal</div>
        </div>
      </div>
    `).join('');
  }

  function quickAddRecipe(id) {
    selectedRecipeId = id;
    const r = RECIPES.find(x => x.id === id);
    openAddModal(selectedDay || 'Mon', 'dinner');
    document.getElementById('addModalRecipeName').textContent = `Adding: ${r.emoji} ${r.title}`;
  }

  function prevWeek()  { weekOffset--; renderPlanner(); }
  function nextWeek()  { weekOffset++; renderPlanner(); }
  function goToToday() { weekOffset = 0; renderPlanner(); }
  function printPlanner()  { window.print(); }
  function exportPlanner() { showToast('📥 Planner exported!', 'success'); }

  function filterSuggestions() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    const drop = document.getElementById('suggestions');
    if (!q) { drop.classList.add('hidden'); return; }
    const found = RECIPES.filter(r => r.title.toLowerCase().includes(q));
    drop.classList.remove('hidden');
    drop.innerHTML = found.length
      ? found.map(r => `<div class="suggestion-item" onclick="quickAddRecipe(${r.id})">${r.emoji} ${r.title} <span style="margin-left:auto;font-size:.75rem;color:var(--text-muted);">${r.kcal} kcal</span></div>`).join('')
      : `<div class="suggestion-item">No recipes found</div>`;
  }

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
    renderPlanner();
    renderSuggestionPanel();
</script>
@endpush
