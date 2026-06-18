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

            <h5 class="mb-6">Basic Information</h5>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

                {{-- Name --}}
                <div>
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', auth()->user()->name) }}" disabled required>

                    @error('name')
                        <small style="color:red;display:block;margin-top:4px;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', auth()->user()->email) }}" disabled required>
                    @error('email')
                        <small style="color:red;display:block;margin-top:4px;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- Phone --}}
                <div>
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control"
                           value="{{ old('phone', auth()->user()->profile->phone ?? '') }}">
                    @error('phone')
                        <small style="color:red;display:block;margin-top:4px;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- Profile Image --}}
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

            {{-- Bio --}}
            <div style="margin-top:16px;">
                <label>Bio</label>
                <textarea name="bio" class="form-control" rows="4">{{ old('bio', auth()->user()->profile->bio ?? '') }}</textarea>
                @error('bio')
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
                                <input type="checkbox" name="diets[]" value="{{ $diet }}" {{ in_array($diet, old('diets', auth()->user()->profile->diets ?? [])) ? 'checked' : '' }}>
                                {{ $diet }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Buttons --}}
            <div style="margin-top:20px;display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="{{ route('dashboard') }}" class="btn btn-outline">Cancel</a>
            </div>

        </form>

    </div>
</div>
@endsection
