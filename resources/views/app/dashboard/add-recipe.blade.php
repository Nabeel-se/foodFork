@extends('layouts.app', [
    'title' => $title,
    'active' => $active,
    'showSearch' => false,
    'topbarTitle' => $topbarTitle,
])

@section('content')
<div class="page-header">
    <h2>{{ $topbarTitle }}</h2>
    <p>Update your profile information below.</p>
</div>

<div class="card">
    <div class="card-body" style="padding:28px;">

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <h5 class="mb-6">General Information</h5>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

                {{-- Title --}}
                <div>
                    <label>Title</label>
                    <input type="text" name="title" class="form-control"
                           value="" disabled required>

                    @error('title')
                        <small style="color:red;display:block;margin-top:4px;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- image --}}
                <div>
                    <label>Profile Image</label>
                    <input type="file" name="avatar" class="form-control">
                    @error('avatar')
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

            </div>

            {{-- Sumaary --}}
            <div style="margin-top:16px;">
                <label>Summary</label>
                <textarea name="bio" class="form-control" rows="4"></textarea>
                @error('summary')
                    <small style="color:red;display:block;margin-top:4px;">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            {{-- Sumaary --}}
            <div style="margin-top:16px;">
                <label>Instruction</label>
                <textarea name="bio" class="form-control" rows="4"></textarea>
                @error('instruction')
                    <small style="color:red;display:block;margin-top:4px;">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <hr style="margin:20px 0;border:0;border-top:1px solid #e5e5e5;">

            <h5 class="mb-6">Prefrences</h5>

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
                </div>
            </div>

            <hr style="margin:20px 0;border:0;border-top:1px solid #e5e5e5;">

            <h5 class="mb-6">Dish Types</h5>

            <div class="container-fluid">
                <div class="row" style="display:flex;gap:20px;flex-wrap:wrap;flex-direction:row;justify-content:start;">
                    @foreach($dish_types as $diet)
                        <div class="col-md-2">
                            <label>
                                <input type="checkbox" name="diets[]" value="{{ $diet }}" >
                                {{ $diet }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <hr style="margin:20px 0;border:0;border-top:1px solid #e5e5e5;">

            {{-- Buttons --}}
            <div style="margin-top:20px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="{{ route('dashboard') }}" class="btn btn-outline">Cancel</a>
            </div>

        </form>

    </div>
</div>
@endsection
