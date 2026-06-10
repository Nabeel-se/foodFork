@extends('layouts.app', [
    'title' => $title,
    'active' => $active,
    'showSearch' => false,
    'topbarTitle' => $topbarTitle,
])

@section('content')
    <div class="page-header">
        <h2>{{ $topbarTitle }}</h2>
        <p>This page is wired into Laravel layout/components and ready for full content migration from your theme.</p>
    </div>

    <!-- Filters Panel (collapsible) -->
    <div id="filtersPanel" class="filters-panel hidden">
        <div class="card card-body" style="margin-bottom:20px;">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;">
            <div class="form-group" style="margin:0;">
            <label class="form-label">Cook Time</label>
            <select class="form-control">
                <option>Any</option>
                <option>Under 15 min</option>
                <option>Under 30 min</option>
                <option>Under 1 hour</option>
                <option>1+ hours</option>
            </select>
            </div>
            <div class="form-group" style="margin:0;">
            <label class="form-label">Difficulty</label>
            <select class="form-control">
                <option>Any</option>
                <option>Easy</option>
                <option>Medium</option>
                <option>Hard</option>
            </select>
            </div>
            <div class="form-group" style="margin:0;">
            <label class="form-label">Calories</label>
            <select class="form-control">
                <option>Any</option>
                <option>Under 300</option>
                <option>300–500</option>
                <option>500–800</option>
                <option>800+</option>
            </select>
            </div>
            <div class="form-group" style="margin:0;">
            <label class="form-label">Dietary</label>
            <select class="form-control">
                <option>Any</option>
                <option>Vegetarian</option>
                <option>Vegan</option>
                <option>Gluten-Free</option>
                <option>Dairy-Free</option>
                <option>Halal</option>
            </select>
            </div>
            <div class="form-group" style="margin:0;">
            <label class="form-label">Servings</label>
            <select class="form-control">
                <option>Any</option>
                <option>1–2</option>
                <option>3–4</option>
                <option>5+</option>
            </select>
            </div>
            <div style="display:flex;align-items:flex-end;">
            <button class="btn btn-primary w-full" onclick="applyFilters()">Apply Filters</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Category Tabs -->
    <div class="category-tabs" id="categoryTabs"></div>

    <!-- Results Count -->
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
        <p style="font-size:.88rem;" id="resultsCount"><strong>24 recipes</strong> found</p>
        <div style="display:flex;align-items:center;gap:8px;">
            <div class="ai-badge" id="searchModeBadge">🔎 Keyword Search</div>
            <span
                aria-label="Search mode legend"
                title="Search mode legend:
🔎 Keyword Search = semantic search is disabled.
🤖 Semantic Search = hybrid vector + keyword ranking is active.
🧠 Semantic Ready (Fallback) = semantic is enabled but this response used keyword fallback."
                style="display:inline-flex;align-items:center;justify-content:center;width:20px;height:20px;border-radius:999px;border:1px solid var(--border);font-size:.72rem;color:var(--text-muted);cursor:help;"
            >ⓘ</span>
        </div>
    </div>

    <!-- Recipe Grid -->
    <div class="grid-4" id="recipeGrid">

        <!-- The JS below renders recipe cards from the data array -->

    </div>

    <!-- Load More -->
    <div style="text-align:center;margin-top:36px;">
        <button class="btn btn-outline btn-lg" onclick="loadMore()">Load More Recipes</button>
    </div>
@endsection

@section("modals")
    <!-- ===== Recipe Detail Modal ===== -->
    <div class="modal-overlay" id="recipeModal">
    <div class="modal" style="max-width:680px;">
        <div class="modal-header">
        <h3 id="modalTitle">Recipe Name</h3>
        <button class="modal-close" onclick="closeModal()">✕</button>
        </div>
        <div class="modal-body">
        <div id="modalThumb" style="height:220px;border-radius:var(--radius);display:flex;align-items:center;justify-content:center;font-size:5rem;margin-bottom:20px;background:linear-gradient(135deg,#D8F3DC,#B7E4C7);"></div>
        <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px;" id="modalBadges"></div>
        <p id="modalDesc" style="margin-bottom:20px;line-height:1.7;"></p>
        <h4 style="margin-bottom:12px;">Dish Types</h4>
        <ul id="modalIngredients" style="display:grid;grid-template-columns:1fr 1fr;gap:6px;margin-bottom:20px;"></ul>
        <h4 style="margin-bottom:12px;">Instructions</h4>
        <ol id="modalInstructions" style="padding-left:18px;display:flex;flex-direction:column;gap:8px;"></ol>
        </div>
        <div class="modal-footer">
        <button class="btn btn-outline" onclick="closeModal()">Close</button>
        <button class="btn btn-secondary" onclick="addToPlanner()">📅 Add to Planner</button>
        <button class="btn btn-primary" onclick="saveRecipe()">🔖 Save Recipe</button>
        </div>
    </div>
    </div>

    <!-- Toast -->
    <div class="toast-container" id="toastContainer"></div>
@endsection

@push("scripts")
    <script>
        const BROWSE_API_TAGS_URL = '{{ route('browse-recipes.tags') }}';
        const BROWSE_API_RECIPES_URL = '{{ route('browse-recipes.api') }}';
        const MEAL_PLANNER_PAGE_URL = '{{ route('meal-planner') }}';

        const state = {
            recipes: [],
            currentRecipes: [],
            selectedTagType: 'all',
            selectedTagValue: 'all',
            perPage: 4,
            currentPage: 1,
            hasMore: false,
            search: '',
            currentView: 'grid',
            semanticEnabled: false,
            semanticUsed: false,
            selectedRecipeId: null,
        };

        function updateSearchModeBadge() {
            const badge = document.getElementById('searchModeBadge');
            if (!badge) {
                return;
            }

            if (!state.semanticEnabled) {
                badge.textContent = '🔎 Keyword Search';
                badge.title = 'Semantic search is disabled';
                return;
            }

            if (state.semanticUsed) {
                badge.textContent = '🤖 Semantic Search';
                badge.title = 'Hybrid semantic ranking is active';
                return;
            }

            badge.textContent = '🧠 Semantic Ready (Fallback)';
            badge.title = 'Semantic is enabled but this response used keyword fallback';
        }

        function normalizeLabel(value) {
            return String(value || '').replace(/[_-]/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
        }

        function escapeHtml(value) {
            return String(value ?? '').replaceAll('&', '&amp;').replaceAll('<', '&lt;').replaceAll('>', '&gt;').replaceAll('"', '&quot;').replaceAll("'", '&#039;');
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

        function catColor(value) {
            const map = {
                'main course': 'primary',
                lunch: 'info',
                dinner: 'secondary',
                breakfast: 'warning',
                soup: 'info',
                dessert: 'secondary',
                vegan: 'primary',
                vegetarian: 'primary',
            };

            return map[value] || 'primary';
        }

        function thumbBg(value) {
            const map = {
                'main course': 'linear-gradient(135deg,#D8F3DC,#B7E4C7)',
                lunch: 'linear-gradient(135deg,#E0F4FF,#B0E0FA)',
                dinner: 'linear-gradient(135deg,#FFD8CC,#FFA888)',
                breakfast: 'linear-gradient(135deg,#FFF8CC,#FFE55A)',
                soup: 'linear-gradient(135deg,#D0E8FF,#A8D8FF)',
                dessert: 'linear-gradient(135deg,#FFD6E0,#FFB3C6)',
                vegan: 'linear-gradient(135deg,#E8FFD8,#C0F0A0)',
                vegetarian: 'linear-gradient(135deg,#DCFFE4,#A0F0B8)',
            };

            return map[value] || 'linear-gradient(135deg,#D8F3DC,#B7E4C7)';
        }

        function renderCategoryTabs(tagsPayload) {
            const categoryTabs = document.getElementById('categoryTabs');
            const dishTypeTags = Array.isArray(tagsPayload?.dish_types) ? tagsPayload.dish_types : [];
            const dietTags = Array.isArray(tagsPayload?.diets) ? tagsPayload.diets : [];

            const combined = [
                { type: 'all', value: 'all', label: 'All', count: null },
                ...dishTypeTags.slice(0, 10).map(tag => ({ type: 'dish_type', value: tag.value, label: tag.label, count: tag.count })),
                ...dietTags.slice(0, 4).map(tag => ({ type: 'diet', value: tag.value, label: tag.label, count: tag.count })),
            ];

            categoryTabs.innerHTML = combined
                .map((tag, index) => {
                    const activeClass = index === 0 ? 'active' : '';
                    const label = tag.type === 'diet' ? `${tag.label} Diet` : tag.label;
                    const countLabel = typeof tag.count === 'number' ? ` <small>(${tag.count})</small>` : '';

                    return `<button class="category-pill ${activeClass}" onclick="filterCategory('${escapeHtml(tag.value)}', '${tag.type}', this)">${escapeHtml(label)}${countLabel}</button>`;
                })
                .join('');
        }

        function renderRecipes(recipes) {
            const grid = document.getElementById('recipeGrid');
            document.getElementById('resultsCount').innerHTML = `<strong>${recipes.length} recipes</strong> loaded`;

            if (recipes.length === 0) {
                grid.innerHTML = `<div class="empty-state" style="grid-column:1/-1"><div class="empty-icon">🍽️</div><h4>No recipes found</h4><p>Try a different category or search term</p></div>`;
                return;
            }

            grid.innerHTML = recipes
                .map(recipe => {
                    const category = recipe.category || 'all';
                    const title = escapeHtml(recipe.title || 'Untitled recipe');
                    const summary = escapeHtml(recipe.summary || 'No summary available.');
                    const imageUrl = recipe.image ? escapeHtml(recipe.image) : '';
                    const caloriesText = recipe.calories ? `${recipe.calories} kcal` : 'N/A kcal';
                    const servingsText = recipe.servings ? recipe.servings : 'N/A';
                    const timeText = formatMinutes(recipe.ready_in_minutes);

                    return `
                        <div class="recipe-card" onclick="openRecipe('${escapeHtml(recipe.id)}')">
                            <div class="recipe-thumb" style="background:${thumbBg(category)};">
                                ${imageUrl ? `<img src="${imageUrl}" alt="${title}" style="width:100%;height:100%;object-fit:cover;border-radius:inherit;"/>` : '<span style="font-size:2rem;">🍽️</span>'}
                                <button class="bookmark" onclick="event.stopPropagation();saveToBookmark('${escapeHtml(recipe.id)}')">🔖</button>
                                <span class="badge badge-${catColor(category)} category-badge">${escapeHtml(normalizeLabel(category))}</span>
                            </div>
                            <div class="recipe-info">
                                <div class="recipe-title">${title}</div>
                                <div class="recipe-meta">
                                    <span>⏱️ ${escapeHtml(timeText)}</span>
                                    <span>👥 ${escapeHtml(servingsText)}</span>
                                    <span>🥗 ${escapeHtml((recipe.diets || []).length ? normalizeLabel(recipe.diets[0]) : 'General')}</span>
                                </div>
                                <div class="recipe-footer">
                                    <div class="recipe-rating"><span class="stars">⭐</span><span>FoodFork</span></div>
                                    <span class="badge badge-primary">${escapeHtml(caloriesText)}</span>
                                </div>
                                <p style="font-size:.82rem;margin-top:8px;line-height:1.5;">${summary}</p>
                            </div>
                        </div>
                    `;
                })
                .join('');
        }

        async function fetchRecipes(reset = true) {
            const nextPage = reset ? 1 : state.currentPage + 1;
            const params = new URLSearchParams({
                page: String(nextPage),
                per_page: String(state.perPage),
            });

            if (state.selectedTagType === 'dish_type' && state.selectedTagValue !== 'all') {
                params.append('dish_types[]', state.selectedTagValue);
            }

            if (state.selectedTagType === 'diet' && state.selectedTagValue !== 'all') {
                params.append('diets[]', state.selectedTagValue);
            }

            if (state.search !== '') {
                params.append('search', state.search);
            }

            const response = await fetch(`${BROWSE_API_RECIPES_URL}?${params.toString()}`, {
                headers: { Accept: 'application/json' },
            });

            if (!response.ok) {
                showToast('Could not load recipes right now.', 'error');
                return;
            }

            const payload = await response.json();
            const data = Array.isArray(payload.data) ? payload.data : [];
            const meta = payload.meta || {};

            state.recipes = reset ? data : state.recipes.concat(data);
            state.currentRecipes = [...state.recipes];
            state.currentPage = meta.current_page || nextPage;
            state.hasMore = Boolean(meta.has_more);
            state.semanticEnabled = Boolean(meta.semantic_enabled);
            state.semanticUsed = Boolean(meta.semantic_used);

            updateSearchModeBadge();

            renderRecipes(state.currentRecipes);
        }

        async function bootstrapBrowse() {
            try {
                const initialSearch = new URLSearchParams(window.location.search).get('search');
                state.search = initialSearch ? initialSearch.trim() : '';

                const tagsResponse = await fetch(BROWSE_API_TAGS_URL, { headers: { Accept: 'application/json' } });
                if (tagsResponse.ok) {
                    const tagsPayload = await tagsResponse.json();
                    renderCategoryTabs(tagsPayload);
                }

                await fetchRecipes(true);
            } catch (error) {
                console.error(error);
                showToast('Failed to load browse data.', 'error');
            }
        }

        function filterCategory(value, type, element) {
            document.querySelectorAll('.category-pill').forEach(pill => pill.classList.remove('active'));
            element.classList.add('active');

            state.selectedTagType = type;
            state.selectedTagValue = value;
            fetchRecipes(true);
        }

        function filterRecipes() {
            const searchInput = document.getElementById('searchInput') || document.getElementById('globalRecipeSearchInput');
            if (!searchInput) {
                return;
            }

            state.search = searchInput.value.trim();
            fetchRecipes(true);
        }

        function sortRecipes(sortBy) {
            const sorted = [...state.currentRecipes];

            if (sortBy === 'calories') {
                sorted.sort((left, right) => (left.calories ?? Number.MAX_SAFE_INTEGER) - (right.calories ?? Number.MAX_SAFE_INTEGER));
            }

            if (sortBy === 'time') {
                sorted.sort((left, right) => (left.ready_in_minutes ?? Number.MAX_SAFE_INTEGER) - (right.ready_in_minutes ?? Number.MAX_SAFE_INTEGER));
            }

            if (sortBy === 'title') {
                sorted.sort((left, right) => String(left.title || '').localeCompare(String(right.title || '')));
            }

            renderRecipes(sorted);
        }

        function toggleFilters() {
            document.getElementById('filtersPanel').classList.toggle('hidden');
        }

        function applyFilters() {
            const dietarySelect = document.querySelector('#filtersPanel select:nth-of-type(4)');
            const selectedDiet = dietarySelect ? String(dietarySelect.value || '').toLowerCase().trim() : '';

            if (selectedDiet && selectedDiet !== 'any') {
                state.selectedTagType = 'diet';
                state.selectedTagValue = selectedDiet;
            }

            fetchRecipes(true);
            showToast('✅ Filters applied');
            document.getElementById('filtersPanel').classList.add('hidden');
        }

        function setView(viewName) {
            state.currentView = viewName;
            const grid = document.getElementById('recipeGrid');
            const gridViewBtn = document.getElementById('gridViewBtn');
            const listViewBtn = document.getElementById('listViewBtn');

            if (viewName === 'grid') {
                grid.className = 'grid-4';
                if (gridViewBtn) {
                    gridViewBtn.classList.add('active-view');
                }
                if (listViewBtn) {
                    listViewBtn.classList.remove('active-view');
                }
            } else {
                grid.className = 'flex flex-col gap-4';
                if (listViewBtn) {
                    listViewBtn.classList.add('active-view');
                }
                if (gridViewBtn) {
                    gridViewBtn.classList.remove('active-view');
                }
            }
        }

        function openRecipe(id) {
            const recipe = state.currentRecipes.find(item => String(item.id) === String(id));
            if (!recipe) {
                return;
            }

            state.selectedRecipeId = String(recipe.id);

            document.getElementById('modalTitle').textContent = recipe.title || 'Recipe';

            const modalThumb = document.getElementById('modalThumb');
            if (recipe.image) {
                modalThumb.innerHTML = `<img src="${escapeHtml(recipe.image)}" alt="${escapeHtml(recipe.title || 'Recipe image')}" style="width:100%;height:100%;object-fit:cover;border-radius:inherit;"/>`;
            } else {
                modalThumb.innerHTML = '<span style="font-size:5rem;">🍽️</span>';
            }

            modalThumb.style.background = thumbBg(recipe.category || 'all');

            const badges = [];
            badges.push(`<span class="badge badge-primary">${recipe.calories ? `${escapeHtml(recipe.calories)} kcal` : 'N/A kcal'}</span>`);
            badges.push(`<span class="badge badge-secondary">⏱️ ${escapeHtml(formatMinutes(recipe.ready_in_minutes))}</span>`);
            badges.push(`<span class="badge badge-info">👥 ${escapeHtml(recipe.servings || 'N/A')} servings</span>`);
            if (recipe.protein) {
                badges.push(`<span class="badge badge-warning">💪 ${escapeHtml(recipe.protein)} ${escapeHtml(recipe.protein_unit || 'g')} protein</span>`);
            }
            if (recipe.fat) {
                badges.push(`<span class="badge badge-warning">🥑 ${escapeHtml(recipe.fat)} ${escapeHtml(recipe.fat_unit || 'g')} fat</span>`);
            }

            document.getElementById('modalBadges').innerHTML = badges.join('');
            document.getElementById('modalDesc').textContent = recipe.summary || 'No summary available.';

            const ingredientsList = Array.isArray(recipe.dish_types) ? recipe.dish_types : [];
            document.getElementById('modalIngredients').innerHTML = ingredientsList.length
                ? ingredientsList.map(item => `<li style="font-size:.88rem;display:flex;align-items:flex-start;gap:6px;"><span style="color:var(--primary);margin-top:2px;">•</span>${escapeHtml(normalizeLabel(item))}</li>`).join('')
                : '<li style="font-size:.88rem;">No dish types available.</li>';

            const instructions = Array.isArray(recipe.instructions) ? recipe.instructions : [];
            document.getElementById('modalInstructions').innerHTML = instructions.length
                ? instructions.map(step => `<li style="font-size:.88rem;line-height:1.6;">${escapeHtml(step)}</li>`).join('')
                : '<li style="font-size:.88rem;line-height:1.6;">No instructions available for this recipe.</li>';

            document.getElementById('recipeModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('recipeModal').classList.remove('active');
        }

        document.getElementById('recipeModal').addEventListener('click', event => {
            if (event.target === document.getElementById('recipeModal')) {
                closeModal();
            }
        });

        function saveToBookmark() {
            showToast('🔖 Recipe saved!', 'success');
        }

        function saveRecipe() {
            showToast('🔖 Recipe saved to your collection!', 'success');
            closeModal();
        }

        function addToPlanner() {
            if (!state.selectedRecipeId) {
                showToast('Select a recipe first.', 'error');

                return;
            }

            const redirectUrl = new URL(MEAL_PLANNER_PAGE_URL, window.location.origin);
            redirectUrl.searchParams.set('recipe_id', state.selectedRecipeId);
            window.location.href = redirectUrl.toString();

            closeModal();
        }

        function loadMore() {
            if (!state.hasMore) {
                showToast('No more recipes to load.');
                return;
            }

            fetchRecipes(false);
        }

        function showToast(message, type = '') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.textContent = message;
            container.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            if (sidebar) {
                sidebar.classList.toggle('open');
            }
        }

        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', filterRecipes);
        }

        bootstrapBrowse();
    </script>
@endpush
