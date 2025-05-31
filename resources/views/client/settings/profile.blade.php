<form action="{{route('profile.update')}}" method="POST">
    @csrf
    <!-- Personal Info Section -->
    <div class="mb-1">
        <strong class="fs-5">Personal Info</strong>
    </div>

    <div class="mb-3 w-100">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ Auth::user()->name }}" required autofocus />
        <x-input-error :messages="$errors->get('name')" class="invalid-feedback d-block" />
    </div>

    <div class="mb-3 w-100">
        <x-input-label for="username" :value="__('Username')" />
        <x-text-input id="username" type="text" name="username" class="form-control" placeholder="Enter username" value="{{ Auth::user()->username }}" required />
        <x-input-error :messages="$errors->get('username')" class="invalid-feedback d-block" />
    </div>

    <div class="mb-3 w-100">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" type="email" name="email" class="form-control" placeholder="Enter email" value="{{ Auth::user()->email }}" required autocomplete="email" />
        <x-input-error :messages="$errors->get('email')" class="invalid-feedback d-block" />
    </div>

    <hr class="mt-5">

    <!-- Password Reset Section -->
    <div class="mb-1">
        <strong class="fs-5">Password Reset</strong>
    </div>

    <!-- New Password -->
    <div class="mb-3 w-100">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Enter new password">
        <x-input-error :messages="$errors->get('new_password')" class="invalid-feedback d-block" />
    </div>

    <!-- Confirm Old Password -->
    <div class="mb-3 w-100">
        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" placeholder="Enter current password" autocomplete="false">
        <x-input-error :messages="$errors->get('new_password_confirmation')" class="invalid-feedback d-block" />
    </div>
    
    <hr class="mt-5">

    <!-- Confirm Info Section -->
    <div class="mb-1">
        <strong class="fs-5">Confirm Changes</strong>
    </div>

    <div class="mb-3 w-100">
        <label for="old_password" class="form-label">Old Password</label>
        <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Enter current password" autocomplete="false">
        <x-input-error :messages="$errors->get('old_password')" class="invalid-feedback d-block" />
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i>
            Save Changes
        </button>
    </div>
</form>
