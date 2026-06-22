@extends('layouts.app', [
    'title' => $title,
    'active' => $active,
    'showSearch' => false,
    'topbarTitle' => $topbarTitle,
])

@section('content')

<style>
    .preview-list, .preview-list1 {
        border: 1px dashed #ccc;
        padding: 10px;
        border-radius: 4px;
        background-color: #f9f9f9;
    }
</style>

<div class="page-header">
    <h2>{{ $topbarTitle }}</h2>
    <p>Update your profile information below.</p>
</div>

<div class="card">
    <div class="card-body" style="padding:28px;">

        <form action="{{ route('add-recipe.post') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h5 class="mb-6">General Information</h5>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

                {{-- Title --}}
                <div>
                    <label>Title</label>
                    <input type="text" name="title" class="form-control"
                           value="" required>

                    @error('title')
                        <small style="color:red;display:block;margin-top:4px;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- image --}}
                <div>
                    <label>Recipe Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control" accept="image/*">
                    @error('thumbnail')
                        <small style="color:red;display:block;margin-top:4px;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

            </div>

            {{-- weight --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

                {{-- Weight in grams --}}
                <div>
                    <label>Protein (optional)</label>

                    <div style="display:flex;align-items:center;">
                        <input type="number" name="protein" class="form-control"
                            placeholder="Enter grams">

                        <span style="padding:10px 12px;background:#f1f1f1;border:1px solid #ccc;border-left:0;">
                            g
                        </span>
                    </div>

                    @error('protein')
                        <small style="color:red;display:block;margin-top:4px;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- Weight in kg --}}
                <div>
                    <label>Fats (optional)</label>

                    <div style="display:flex;align-items:center;">
                        <input type="number" name="fats" class="form-control"
                            placeholder="Enter grams">

                        <span style="padding:10px 12px;background:#f1f1f1;border:1px solid #ccc;border-left:0;">
                            g
                        </span>
                    </div>

                    @error('fats')
                        <small style="color:red;display:block;margin-top:4px;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- Weight in kg --}}
                <div>
                    <label>Calories (optional)</label>

                    <div style="display:flex;align-items:center;">
                        <input type="number" name="calories" class="form-control"
                            placeholder="Enter grams">

                        <span style="padding:10px 12px;background:#f1f1f1;border:1px solid #ccc;border-left:0;">
                            g
                        </span>
                    </div>

                    @error('calories')
                        <small style="color:red;display:block;margin-top:4px;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- Minutes to be taken --}}
                <div>
                    <label>Minutes to be taken (optional)</label>

                    <div style="display:flex;align-items:center;">
                        <input type="number" name="minutes" class="form-control"
                            placeholder="Enter minutes">
                    </div>

                    @error('minutes')
                        <small style="color:red;display:block;margin-top:4px;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

            </div>

            {{-- Summary --}}
            <div style="margin-top:16px;">
                <label>Summary</label>
                <textarea name="summary" class="form-control" rows="4"></textarea>
                @error('summary')
                    <small style="color:red;display:block;margin-top:4px;">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <hr style="margin:20px 0;border:0;border-top:1px solid #e5e5e5;">

            <h5 class="mb-6">Preferences</h5>

            <div class="container-fluid">
                <div class="row" style="display:flex;gap:20px;flex-wrap:wrap;flex-direction:row;justify-content:start;">
                    @foreach($diets as $diet)
                        <div class="col-md-2">
                            <label>
                                <input type="checkbox" name="diets[]" value="{{ $diet }}" >
                                {{ $diet }}
                            </label>
                        </div>
                    @endforeach
                    @error('diets')
                        <small style="color:red;display:block;margin-top:4px;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>

            <hr style="margin:20px 0;border:0;border-top:1px solid #e5e5e5;">

            <h5 class="mb-6">Dish Types</h5>

            <div class="container-fluid">
                <div class="row" style="display:flex;gap:20px;flex-wrap:wrap;flex-direction:row;justify-content:start;">
                    @foreach($dish_types as $dish_type)
                        <div class="col-md-2">
                            <label>
                                <input type="checkbox" name="dish_types[]" value="{{ $dish_type }}" >
                                {{ $dish_type }}
                            </label>
                        </div>
                    @endforeach
                    @error('dish_types')
                        <small style="color:red;display:block;margin-top:4px;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>

            <hr style="margin:20px 0;border:0;border-top:1px solid #e5e5e5;">

            <h5 class="mb-6">Add ingredients</h5>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

            <div class="ingredient-list">

                <div class="ingredient-row" style="display:flex;gap:8px;">
                    <input type="text" name="ingredients[]" class="form-control"
                        placeholder="Ingredient" onkeyup="addPreview()">

                    <input type="text" name="value[]" class="form-control"
                        placeholder="Value" onkeyup="addPreview()">

                    <input type="text" name="unit[]" class="form-control"
                        placeholder="Unit" onkeyup="addPreview()">

                    <!-- FIRST ROW: ADD BUTTON -->
                    <button type="button" class="btn btn-outline" onclick="addIngredient()">
                        Add
                    </button>
                </div>

            </div>

            <div class="preview-list"></div>

            </div>

            <hr style="margin:20px 0;border:0;border-top:1px solid #e5e5e5;">

            <h5 class="mb-6">Add instruction</h5>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

                <div class="ingredient-list1" style="display:flex;flex-direction:column;gap:8px;">
                    @error('instructions')
                        <small style="color:red;display:block;margin-top:4px;">
                            {{ $message }}
                        </small>
                    @enderror
                    <div style="display:flex;gap:8px;">
                        <input type="text" name="instructions[]" class="form-control"
                               placeholder="Enter instruction" required onkeyup="addPreview1()">

                        <button type="button" class="btn btn-outline" onclick="addIngredient1()">Add</button>
                    </div>

                </div>

                <div class="preview-list1">
                </div>

            </div>

            {{-- Buttons --}}
            <div style="margin-top:20px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">Add Recipe</button>
                <a href="{{ route('dashboard') }}" class="btn btn-outline">Cancel</a>
            </div>

        </form>

    </div>
</div>


<script>
    // function addIngredient() {
    //     const container = document.querySelector('.ingredient-list');
    //     const firstRow = container.querySelector('.ingredient-row');

    //     const clone = firstRow.cloneNode(true);

    //     // clear inputs
    //     clone.querySelectorAll('input').forEach(input => input.value = '');

    //     // remove Add button in cloned row
    //     const addBtn = clone.querySelector('button');
    //     if (addBtn) addBtn.remove();

    //     // create Delete button
    //     const deleteBtn = document.createElement('button');
    //     deleteBtn.type = 'button';
    //     deleteBtn.className = 'btn btn-danger';
    //     deleteBtn.textContent = 'Delete';

    //     deleteBtn.onclick = function () {
    //         clone.remove();
    //         addPreview();
    //     };

    //     clone.appendChild(deleteBtn);

    //     container.appendChild(clone);
    // }

    function addIngredient() {
        const container = document.querySelector('.ingredient-list');
        const rows = container.querySelectorAll('.ingredient-row');

        // Get the last row
        const lastRow = rows[rows.length - 1];

        const ingredient = lastRow.querySelector('input[name="ingredients[]"]').value.trim();
        const value = lastRow.querySelector('input[name="value[]"]').value.trim();
        const unit = lastRow.querySelector('input[name="unit[]"]').value.trim();

        // Case 1 & Case 2:
        // Don't add a new row if any field in the last row is empty
        if (ingredient === '' || value === '' || unit === '') {
            alert('Please fill all fields before adding a new ingredient.');
            return;
        }

        // Clone the first row
        const newRow = rows[0].cloneNode(true);

        // Clear inputs
        newRow.querySelectorAll('input').forEach(input => {
            input.value = '';
        });

        // Change Add button to Delete button
        const btn = newRow.querySelector('button');
        btn.textContent = 'Delete';
        btn.className = 'btn btn-danger';
        btn.onclick = function () {
            newRow.remove();
            addPreview();
        };

        container.appendChild(newRow);
    }

    function addIngredient1() {
        const ingredientList = document.querySelector('.ingredient-list1');
        const previewList = document.querySelector('.preview-list1');

        const newIngredient = document.createElement('div');
        newIngredient.style.display = 'flex';
        newIngredient.style.gap = '8px';

        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'instructions[]';
        input.className = 'form-control';
        input.placeholder = 'Enter instruction';
        input.required = true;

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'btn btn-outline';
        removeButton.textContent = 'Remove';
        removeButton.onclick = () => {
            ingredientList.removeChild(newIngredient);
            previewList.removeChild(previewItem);
        };

        newIngredient.appendChild(input);
        newIngredient.appendChild(removeButton);
        ingredientList.appendChild(newIngredient);

        // Add to preview
        const previewItem = document.createElement('div');
        previewItem.textContent = input.value;
        previewList.appendChild(previewItem);

        // Update preview on input change
        input.addEventListener('input', () => {
            previewItem.textContent = input.value;
        });
    }

    function addPreview() {
        const ingredientList = document.querySelector('.ingredient-list');
        const previewList = document.querySelector('.preview-list');

        previewList.innerHTML = '';

        const rows = ingredientList.querySelectorAll('.ingredient-row');

        rows.forEach(row => {
            const ingredient = row.querySelector('input[name="ingredients[]"]')?.value || '';
            const value = row.querySelector('input[name="value[]"]')?.value || '';
            const unit = row.querySelector('input[name="unit[]"]')?.value || '';

            if (ingredient.trim() !== '' || value.trim() !== '' || unit.trim() !== '') {
                const previewItem = document.createElement('div');

                previewItem.textContent = `${ingredient} ${value} ${unit}`.trim();

                previewList.appendChild(previewItem);
            }
        });
    }
    function addPreview1() {
        const ingredientList = document.querySelector('.ingredient-list1');
        const previewList = document.querySelector('.preview-list1');
        console.log('addPreview1 called'); // Debugging line
        // Clear the preview list
        previewList.innerHTML = '';

        // Loop through all ingredient inputs and add to preview
        const inputs = ingredientList.querySelectorAll('input[name="instructions[]"]');
        inputs.forEach(input => {
            const previewItem = document.createElement('div');
            previewItem.textContent = input.value;
            previewList.appendChild(previewItem);
        });
    }
</script>
@endsection
