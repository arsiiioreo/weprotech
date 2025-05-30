<form action="">
    <div class="mb-3">
        <small class="text-muted"><strong>Vault Password</strong></small>
    </div>

    <div class="mb-3 w-100">
        <label for="old_password" class="form-label">Old Password</label>
        <input 
            type="password" 
            id="old_password" 
            name="old_password" 
            class="form-control" 
            placeholder="Enter old password" 
            required 
        />
    </div>

    <div class="mb-3 w-100">
        <label for="new_password" class="form-label">New Password</label>
        <input 
            type="password" 
            id="new_password" 
            name="new_password" 
            class="form-control" 
            placeholder="Enter new password" 
            required 
        />
    </div>

    <div class="mb-3 w-100">
        <label for="confirm_password" class="form-label">Confirm New Password</label>
        <input 
            type="password" 
            id="confirm_password" 
            name="confirm_password" 
            class="form-control" 
            placeholder="Confirm new password" 
            required 
        />
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i>
            Save Changes
        </button>
    </div>
</form>
