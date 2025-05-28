<!-- Vault Password Modal -->
<div class="modal fade" id="vaultPassword" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2">
                <span><i class="bi bi-lock-fill fs-4"></i></span>
                <h5 class="modal-title ms-3" id="accountModalLabel">Setup Vault Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('set.vault.password') }}" method="POST">
                <div class="modal-body pt-3">
                    @csrf
                    <div class="d-flex flex-column mb-3">
                        <x-input-label for="vault_password" :value="__('Password')" />
                        <x-text-input id="vault_password" type="password" name="vault_password" placeholder="Enter Password" required autofocus/>
                        <x-input-error :messages="$errors->get('vault_password')" class="invalid-feedback" />
                    </div>
                    
                    <div class="d-flex flex-column mb-3">
                        <x-input-label for="vault_password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="vault_password_confirmation" type="password" name="vault_password_confirmation" placeholder="Enter Password" required/>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="invalid-feedback" />
                    </div>

                    <i class="p-3">
                        <small class="text-primary">
                            * Setting up an additional security is a requirement for this app to run efficiently.
                            This protects your data and ensures that only you can access it.    
                        </small>
                    </i> 
                </div>
                
                <div class="modal-footer">
                    <div class="text-end">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>