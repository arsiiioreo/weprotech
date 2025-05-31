<form action="{{route('updateVault')}}" method="POST">
    @csrf
    <div class="mb-3">
        <small class="text-muted"><strong>Vault Password</strong></small>
    </div>

    <div class="mb-3 w-100">
        <label for="vault_new_password" class="form-label">New Password</label>
        <input type="password" id="vault_new_password" name="vault_new_password" class="form-control" placeholder="Enter new password" required>
        <x-input-error :messages="$errors->get('vault_new_password')" class="invalid-feedback d-block" />
    </div>

    <div class="mb-3 w-100">
        <label for="vault_new_password_confirmation" class="form-label">Confirm New Password</label>
        <input type="password" id="vault_new_password_confirmation" name="vault_new_password_confirmation" class="form-control" placeholder="Enter current password" autocomplete="false" required>
        <x-input-error :messages="$errors->get('vault_new_password_confirmation')" class="invalid-feedback d-block" />
    </div>

    <div class="mb-3 w-100">
        <label for="vault_password" class="form-label">Old New Password</label>
        <input type="password" id="vault_password" name="vault_password" class="form-control" placeholder="Enter current password" autocomplete="false" required>
        <x-input-error :messages="$errors->get('vault_password')" class="invalid-feedback d-block" />
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i>
            Save Changes
        </button>
    </div>
</form>
