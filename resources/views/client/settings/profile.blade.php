<form action="">
    <!-- Personal Info Section -->
    <div class="mb-1">
        <strong class="fs-5">Personal Info</strong>
    </div>

    <div class="mb-3 w-100">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}" required autofocus />
        <x-input-error :messages="$errors->get('name')" class="invalid-feedback d-block" />
    </div>

    <div class="mb-3 w-100">
        <x-input-label for="username" :value="__('Username')" />
        <x-text-input id="username" type="text" name="username" class="form-control" placeholder="Enter username" value="{{ old('username') }}" required />
        <x-input-error :messages="$errors->get('username')" class="invalid-feedback d-block" />
    </div>

    <div class="mb-3 w-100">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}" required autocomplete="email" />
        <x-input-error :messages="$errors->get('email')" class="invalid-feedback d-block" />
    </div>

    <hr class="mt-5">

    <!-- Contact Info Section -->
    <div class="mb-1">
        <strong class="fs-5">Contact Info</strong>
    </div>

    <div class="mb-3 w-100">
        <label for="new-password" class="form-label">New Password</label>
        <input type="password" id="new-password" name="password" class="form-control" placeholder="Enter Password">
    </div>
    
    <div class="mb-3 w-100">
        <label for="old-password" class="form-label">Old Password</label>
        <input type="password" id="old-password" name="old_password" class="form-control" placeholder="Confirm Password">
    </div>
    
    <hr class="mt-5">

    <!-- Confirm Info Section -->
    <div class="mb-1">
        <strong class="fs-5">Confirm Changes</strong>
    </div>

    <div class="mb-3 w-100">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password">
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i>
            Save Changes
        </button>
    </div>
</form>
