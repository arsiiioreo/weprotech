<!-- Modal -->
@if(session('showLoginModal'))
<script>
    window.addEventListener('load', () => {
        const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
    });
</script>
@endif
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog mt-5">
        <div class="modal-content" style="position: relative;">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 15px; right: 15px;"></button>

                <div class="d-flex flex-column align-items-center mb-4 mt-2">
                    <img class="my-3" src="{{ asset('images/dark_logo.png')}}" alt="" style="width: 150px; height: auto;">
                    <h1 class="text-center" style="font-size: 1.5rem; font-weight: 900;">WEPROTECH - LOGIN</h1>
                </div>

                <div class="mt-4 d-flex flex-column align-items-center">
                    {{-- Data Inputs nilagay ko na kasi ang hirap hanapin HHHAHAHAAHAH --}}
                    <div class="d-flex flex-column mb-3 w-75">
                        <x-input-label for="user" :value="__('Email or Username')" />
                        <x-text-input id="user" type="text" name="user" placeholder="Enter username or email" value="{{old('user')}}" required autofocus autocomplete="email" />
                        <x-input-error :messages="$errors->get('user')" class="invalid-feedback" />
                    </div>
                    <div class="d-flex flex-column mb-2 w-75">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="passwordLogin" type="password" name="password" placeholder="Enter password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="invalid-feedback" />
                    </div>

                    <div class="w-75 d-flex flex-column align-items-center justify-content-center mt-1">
                        <div class="d-flex align-items-center justify-content-between mb-2 w-100">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                <label class="form-check-label" for="checkDefault">
                                    Show Password
                                </label>
                            </div>
                            {{-- <small><a href="{{route('password.request')}}" style="color: #191919 !important">Forgot password?</a></small> --}}
                            <a href="#" style="color: #191919 !important"><small>Forgot password?</a></small>
                        </div>
                        <button type="submit" class="fw-semibold btn w-100 p-2 mt-1" style="background-color: #191919; color: white;">LOGIN</button>
                        <p class="mt-4 text-center"><small>Doesn't have an account yet? <span class="fw-bold" data-bs-toggle="modal" data-bs-target="#registrationModal" style="cursor: pointer"><small>Register</small></span></small></p>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-4 w-75">
                        <span class="" style="border-bottom: 1px solid #191919; width: 45%; height:auto;"></span>
                        <p class="mb-0 mx-2" style="font-size: 12px;">or</p>
                        <span class="" style="border-bottom: 1px solid #191919; width: 45%; height:auto;"></span>
                    </div>
                    <div class="w-75 d-flex flex-column justify-content-center mb-5" style="gap: 1rem;">
                        <button type="button" class="fw-bold btn w-100 p-2" style="border: 2px solid #191919; color: #191919;" onclick="featureUnavailable()">
                            <img src="{{ asset('images/google_pic.png') }}" 
                            alt="" class="me-3" style="width: auto; height: 20px;">
                            <span class="mb-0 fw-semibold">Continue with Google</span>
                        </button>
                        <button type="button" class="fw-bold btn w-100 p-2" style="border: 2px solid #191919; color: #191919;" onclick="featureUnavailable()">
                            <img src="{{ asset('images/facebook_pic.png') }}" 
                            alt="" class="me-3" style="width: auto; height: 20px;">
                            <span class="mb-0 fw-semibold">Continue with Facebook</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script> 
    document.getElementById('checkDefault')?.addEventListener('change', function () {
        const passField = document.getElementById('passwordLogin');
        passField.type = this.checked ? 'text' : 'password';
    });
</script>