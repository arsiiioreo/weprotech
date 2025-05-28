<!DOCTYPE html>
<html>
    <x-head :title="$title"/>
    
    <body class="antialiased d-flex flex-column justify-content-center w-100" style="background-color: #191919; position: relative;">
        <div class="first-section w-100 p-4 d-flex flex-column" style="position: relative; min-height: 100vh; height: auto; background: linear-gradient(to bottom,  #191919 10%, #1919197e, #272727);">
            <svg style="position: absolute; top: 0; left: 0; width: auto; height: 100%; z-index: -1;" id="visual" viewBox="0 0 900 600" width="900" height="600"><rect width="900" height="600" fill="#191919"></rect><g><g transform="translate(310 197)"><path d="M0 -40.2L34.8 -20.1L34.8 20.1L0 40.2L-34.8 20.1L-34.8 -20.1Z" fill="none" stroke="#727272" stroke-width="2"></path></g><g transform="translate(219 249)"><path d="M0 -29L25.1 -14.5L25.1 14.5L0 29L-25.1 14.5L-25.1 -14.5Z" fill="none" stroke="#727272" stroke-width="2"></path></g><g transform="translate(525 296)"><path d="M0 -32L27.7 -16L27.7 16L0 32L-27.7 16L-27.7 -16Z" stroke="#727272" fill="none" stroke-width="2"></path></g><g transform="translate(402 522)"><path d="M0 -37L32 -18.5L32 18.5L0 37L-32 18.5L-32 -18.5Z" stroke="#727272" fill="none" stroke-width="2"></path></g><g transform="translate(835 166)"><path d="M0 -38L32.9 -19L32.9 19L0 38L-32.9 19L-32.9 -19Z" stroke="#727272" fill="none" stroke-width="2"></path></g><g transform="translate(508 382)"><path d="M0 -28L24.2 -14L24.2 14L0 28L-24.2 14L-24.2 -14Z" stroke="#727272" fill="none" stroke-width="2"></path></g><g transform="translate(526 593)"><path d="M0 -29L25.1 -14.5L25.1 14.5L0 29L-25.1 14.5L-25.1 -14.5Z" stroke="#727272" fill="none" stroke-width="2"></path></g><g transform="translate(533 166)"><path d="M0 -16L13.9 -8L13.9 8L0 16L-13.9 8L-13.9 -8Z" stroke="#727272" fill="none" stroke-width="2"></path></g><g transform="translate(687 568)"><path d="M0 -20L17.3 -10L17.3 10L0 20L-17.3 10L-17.3 -10Z" stroke="#727272" fill="none" stroke-width="2"></path></g><g transform="translate(103 22)"><path d="M0 -26L22.5 -13L22.5 13L0 26L-22.5 13L-22.5 -13Z" stroke="#727272" fill="none" stroke-width="2"></path></g><g transform="translate(17 112)"><path d="M0 -24L20.8 -12L20.8 12L0 24L-20.8 12L-20.8 -12Z" stroke="#727272" fill="none" stroke-width="2"></path></g><g transform="translate(804 268)"><path d="M0 -34L29.4 -17L29.4 17L0 34L-29.4 17L-29.4 -17Z" stroke="#727272" fill="none" stroke-width="2"></path></g><g transform="translate(2 201)"><path d="M0 -31L26.8 -15.5L26.8 15.5L0 31L-26.8 15.5L-26.8 -15.5Z" stroke="#727272" fill="none" stroke-width="2"></path></g><g transform="translate(223 548)"><path d="M0 -38L32.9 -19L32.9 19L0 38L-32.9 19L-32.9 -19Z" stroke="#727272" fill="none" stroke-width="2"></path></g><g transform="translate(97 412)"><path d="M0 -18L15.6 -9L15.6 9L0 18L-15.6 9L-15.6 -9Z" stroke="#727272" fill="none" stroke-width="2"></path></g><g transform="translate(244 40)"><path d="M0 -22L19.1 -11L19.1 11L0 22L-19.1 11L-19.1 -11Z" stroke="#727272" fill="none" stroke-width="2"></path></g></g></svg>
            <div class="header d-flex justify-content-between align-items-center p-2 w-100 mb-5">
                <div class="d-flex align-items-center ms-5">
                    <img src="{{ asset('images/light_logo.png') }}" alt="Logo" class="logo me-3" style="height: auto; width: 70px;">
                    <h1 class="text-white fw-bold m-0" style="font-size: 1.5rem;">WEPROTECH</h1>
                </div>
                <div class="d-flex align-items-center justify-content-between me-5" style="gap: 3rem;">
                    <a href="#">Services</a>
                    <a href="#">How it works?</a>
                    @if ($loggedIn)
                    <a href="{{route('home')}}" class="bg-secondary py-2 px-3 rounded">Home</a>
                    @else
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#registrationModal">Register</a>
                    @endif
                </div>
            </div>
            
            <div class="d-flex justify-content-center align-item-center flex-column h-100">
                <div class="d-flex align-items-center justify-content-between px-5 w-100 mt-4">
                    <div class="d-flex flex-column justify-content-center ms-5" style="width: 60%">
                        <h1 class="text-white fw-bold mb-3" style="font-size: 7rem;">WEPROTECH</h1>
                        <p class="mb-4 text-white fs-5 fw-light">
                            Forgot your password again? You're not alone — but you don't have to be stuck. 
                            Start your WeProTech journey today and take back control with secure, 
                            easy-to-access password management built for peace of mind.
                        </p>
                        <button class="btn mt-1 fw-semibold" style="height: 55px; width: 250px; border-radius: 10px; background-color: white; color: #191919;" data-bs-toggle="modal" data-bs-target="#registrationModal">Get Started</button>
                    </div>
                    <div class="d-flex justify-content-center align-items-center" style="width: 40%">
                        <img src="{{ asset('images/landing_banner.png')}}" alt="" width="70%"; height="auto">
                    </div>
                </div>
                @php
                    $countCards = [
                        "user" => ['icon' => 'person-fill', 'var' => 'userCount', 'text' => 'users'],
                        "visitors" => ['icon' => 'people-fill', 'var' => 'visitorCount', 'text' => 'visitors'],
                        "accountCount" => ['icon' => 'lock-fill', 'var' => 'accountCount', 'text' => 'accounts secured'],
                        "messageCount" => ['icon' => 'pen-fill', 'var' => 'messageCount', 'text' => 'secrets secured'],
                    ]; 
                @endphp
                <div class="d-flex justify-self-end align-items-center ms-5 mt-5 ps-5 pt-5" style="gap: 2rem;">
                    @foreach ($countCards as $item)
                        <div class="count-card d-flex flex-column justify-content-center pe-5" style="border-right: 1px solid rgba(255, 255, 255, 0.25);">
                            <i class="bi bi-{{$item['icon']}} text-white mb-3 ms-1" style="font-size: 1.5rem;"></i>
                            <h2 class="text-white fw-bold mb-0">{{ ${$item['var']} }}+</h2>
                            <p class="text-white mb-0" style="font-size: 13px; font-weight: 300;">{{$item['text']}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="bg-white p-5 w-100" style="height: auto;">
            <div class="text-center py-5">
                <h1 class="fw-bold">OUR SERVICES</h1>
            </div>
            <div class="d-flex justify-content-evenly align-items-center flex-wrap py-5 mt-3">
                <div class="service-card d-flex flex-column align-items-center text-center px-2" style="position: relative; overflow: visible; border: 3px solid #191919; border-radius: 10px; width: 280px; height: 350px;">
                    <i class="bi bi-lock my-5" style="font-size: 3rem; font-weight: 800"></i>
                    <h5 class="fw-bold mb-3">Secure Vault Storage</h5>
                    <p class="ms-1 mb-0" style="font-size: 13px; font-weight: 300;">We provide encryption for your sensitive data—passwords, PINs, notes, keys—you name it. Your secrets stay yours.</p>
                </div>
                <div class="service-card d-flex flex-column align-items-center text-center px-2" style="border: 3px solid #191919; border-radius: 10px; width: 280px; height: 350px;">
                    <i class="bi bi-key my-5" style="font-size: 3rem; font-weight: 800"></i>
                    <h5 class="fw-bold mb-3">Password Management</h5>
                    <p class="ms-1 mb-0" style="font-size: 13px; font-weight: 300;">Save and organize your passwords across platforms. Say goodbye to "forgot password?" days.</p>
                </div>
                <div class="service-card d-flex flex-column align-items-center text-center px-2" style="border: 3px solid #191919; border-radius: 10px; width: 280px; height: 350px;">
                    <i class="bi bi-paperclip my-5" style="font-size: 3rem; font-weight: 800"></i>
                    <h5 class="fw-bold mb-3">Encrypted Notes & Documents</h5>
                    <p class="ms-1 mb-0" style="font-size: 13px; font-weight: 300;">Need to jot down recovery phrases, confidential data, or secret plans to take over the world? Store them safely inside encrypted containers.</p>
                </div>
            </div>
        </div>

        <div class="text-white p-5 w-100" style="height: auto;">
            <div class="text-center py-5">
                <h1 class="fw-bold">HOW DOES IT WORK?</h1>
            </div>
            <div class="d-flex justify-content-evenly align-items-center flex-wrap">
                <div class="d-flex flex-column justify-content-start py-5">
                    <p class="fw-bold mb-4" style="font-size: 7rem; background: linear-gradient(to bottom, white, #191919 70%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">1</p>
                    <h4 class="fw-bold mb-3">Create Your Vault</h4>
                    <p class="ms-1 mb-0" style="font-size: 13px; font-weight: 300;">Sign up or log in to start saving your sensitive info securely.</p>
                </div>
                <div class="d-flex flex-column justify-content-start py-5">
                    <p class="fw-bold mb-4" style="font-size: 7rem; background: linear-gradient(to bottom, white, #191919 70%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">2</p>
                    <h4 class="fw-bold mb-3">Lock it Down with a PIN</h4>
                    <p class="ms-1 mb-0" style="font-size: 13px; font-weight: 300;">Lock your data with a personal PIN for extra protection.</p>
                </div>
                <div class="d-flex flex-column justify-content-start py-5">
                    <p class="fw-bold mb-4" style="font-size: 7rem; background: linear-gradient(to bottom, white, #191919 70%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">3</p>
                    <h4 class="fw-bold mb-3">You're Protected</h4>
                    <p class="ms-1 mb-0" style="font-size: 13px; font-weight: 300;">Add passwords, notes, and secrets — safely stored, easy to access..</p>
                </div>
            </div>
        </div>
        <div class="p-5 d-flex justify-content-between">
            <div class="ms-5">
                <h3 class="fw-bold text-white">START YOUR JOURNEY!</h3>
            </div>
            <div class="me-5">
                <button data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-light border-light bg-none ms-4 fw-bold px-5">LOGIN</button>
                <button data-bs-toggle="modal" data-bs-target="#registrationModal" class="btn btn-light ms-4 fw-bold px-5">REGISTER</button>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between" style="background-color: #dadada; height: 400px; width: 100%;">
            <div class="d-flex flex-column justify-content-center align-items-center h-100 w-25">
                <img src="{{asset('images/dark_logo.png')}}" alt="" style="width: 250px; height: auto;">
                <p class="fs-2 mt-2" style="font-weight: 900">WEPROTECH</p>
            </div>
            <div class="d-flex justify-content-center align-items-center h-100 w-50" style="font-size: 0.85rem;">
                <div class="text-center w-25 mx-5">
                    <h5 class="fw-bold mb-3">About Us</h5>
                    <p class="">
                        WeProTech is a modern security that lets you
                        store your passwords, notes, and other sensitive information securely.
                        We are committed to providing you with the best security experience possible,
                        all in one encrypted vault.
                    </p>
                </div>
                <div class="mx-5">
                    <div class="d-flex flex-column mb-4">
                        <h5 class="fw-bold mb-3">Contact Us</h5>
                        <p class="mb-1">
                            <span class="me-2"><i class="bi bi-phone"></i></span>
                            <span>+639012345678</span>
                        </p>
                        <p class="mb-1">
                            <span class="me-2"><i class="bi bi-envelope"></i></span>
                            <span>reignromarchryzel.balico@isu.edu.ph</span>
                        </p>
                        <p class="mb-1">
                            <span class="me-2"><i class="bi bi-envelope"></i></span>
                            <span>eugenge.g.tobias@isu.edu.ph</span>
                        </p>
                    </div>
                    
                    <div class="d-flex flex-column">
                        <h5 class="fw-bold mb-3">Features</h5>
                        <ul>
                            <li class="mb-1">Account Vault</li>
                            <li class="mb-1 position-relative">
                                Diary
                                <span class="position-absolute top-0 badge text-danger fw-semibold" style="font-size: 0.65rem;">
                                    <i>beta</i>
                                </span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <footer>
            <div class="text-center text-white py-4">
                <p class="mb-0" style="font-size: 0.8rem">© 2025 WeProTech. All rights reserved.</p>
            </div>
        </footer>
        <div>
            <x-login />
        </div>
        <div>
            <x-registration />
        </div>
    </body>
</html>