<!-- Modal -->
@if(session('showRegistrationModal'))
<script>
    window.addEventListener('load', () => {
        console.log('Session trigger:', document.getElementById('registrationModal'));
        const registrationModal = new bootstrap.Modal(document.getElementById('registrationModal'));
        registrationModal.show();
    });
</script>
@endif
<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog mt-2">
        <div class="modal-content" style="position: relative;">
            <form method="POST" action="{{route('register')}}">
                @csrf
                <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 15px; right: 15px;"></button>

                <div class="d-flex flex-column align-items-center mb-4 mt-2">
                    <img class="my-3" src="{{ asset('images/dark_logo.png')}}" alt="" style="width: 150px; height: auto;">
                    <h1 class="text-center" style="font-size: 1.5rem; font-weight: 900;">WEPROTECH - REGISTER</h1>
                </div>

                <div class="mt-4 d-flex flex-column align-items-center">
                    <div class="d-flex flex-column mb-3 w-75">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" type="text" name="name" placeholder="Enter your name" value="{{old('name')}}" required autofocus/>
                        <x-input-error :messages="$errors->get('name')" class="invalid-feedback" />
                    </div>
                    <div class="d-flex flex-column mb-3 w-75">
                        <x-input-label for="username" :value="__('Username')" />
                        <x-text-input id="username" type="text" name="username" placeholder="Enter username" value="{{old('username')}}" required autofocus/>
                        <x-input-error :messages="$errors->get('username')" class="invalid-feedback" />
                    </div>
                    <div class="d-flex flex-column mb-3 w-75">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" type="email" name="email" placeholder="Enter email" value="{{old('email')}}" required autocomplete="email"/>
                        <x-input-error :messages="$errors->get('email')" class="invalid-feedback" />
                    </div>
                    <div class="d-flex flex-column mb-3 w-75">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="passwordRegistration" type="password" name="password" placeholder="Enter password" required/>
                        <x-input-error :messages="$errors->get('password')" class="invalid-feedback" />
                    </div>
                    <div class="d-flex flex-column mb-3 w-75">
                        <x-input-label for="password_confirmation" :value="__('Confirmation Password')" />
                        <x-text-input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm your password" required/>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="invalid-feedback" />
                    </div>
                    <div class="w-75 d-flex flex-column align-items-center justify-content-center mt-1">
                        <button type="submit" class="fw-semibold btn w-100 p-2" style="background-color: #191919; color: white;">REGISTER</button>
                        <p class="mt-4"><small>Already have an account? <span class="fw-bold" data-bs-toggle="modal" data-bs-target="#loginModal" style="cursor: pointer"><small>Login</small></span></small></p>
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

<style scoped>
    form label {
        font-size: 0.85rem !important;
        color: #191919 !important;
        font-weight: 700;
    }

    form input[type=text],
    form input[type=email],
    form input[type=password],
    form input[type=number]
    {
        border-bottom: 2px solid #191919 !important;
        background-color: #f2f2f2 !important;
        font-size: 0.85rem !important;
    }

    form input[type=text],
    form input[type=email],
    form input[type=password],
    form input[type=number],
    form button {
        padding: 10px 15px !important;
    }

    @media (max-width: 576px) {
    .modal-body {
        padding: 0px !important;
    }
    .modal-body h1 {
        font-size: 1.2rem;
    }
    }
</style>