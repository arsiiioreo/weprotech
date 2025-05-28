<aside class="d-flex flex-column align-items-center text-white p-4" style="height: 100vh">
    <div class="text-center border-bottom mb-4 py-2">
        <img class="logo img-fluid mb-2" src="{{ asset('images/light_logo.png') }}" alt="" style="width: 75px;">
        <h1 class="fw-bold fs-6">WEPROTECH</h1>
    </div>

    @php
        $routes = [
            'home' => ['icon' => 'bi-house-door-fill', 'label' => 'Home'],
            'accounts' => ['icon' => 'bi-person-vcard-fill', 'label' => 'Accounts'],
            'diary' => ['icon' => 'bi-book-fill', 'label' => 'Diary'],
            'settings' => ['icon' => 'bi-gear-fill', 'label' => 'Settings'],
            'profile' => ['icon' => 'bi-person-circle', 'label' => 'Profile'],
        ];
    @endphp

    <div class="d-flex flex-column justify-content-between text-center h-100 w-100 overflow-y-auto">
        <ul class="navbar-nav flex-grow-1">
            @foreach ($routes as $route => $data)
                <li class="{{ request()->is($route) ? 'active' : '' }} mb-1 rounded-2">
                    <a href="{{ route($route) }}" class="text-white text-decoration-none d-flex flex-column align-items-center p-3">
                        <i class="bi {{ $data['icon'] }} mb-1"></i>
                        <small>{{ $data['label'] }}</small>
                    </a>
                </li>
            @endforeach
        </ul>
        <ul class="navbar-nav flex-grow-1 justify-content-end">
            <li class="active rounded-2">
                {{-- <a href="{{ route('logout') }}" class="text-white text-decoration-none d-flex flex-column align-items-center p-3"> --}}
                <a href="{{ route('logout') }}" class="text-white text-decoration-none d-flex flex-column align-items-center p-3">
                    <i class="bi bi-box-arrow-right mb-1"></i>
                    <small>Logout</small>
                </a>
            </li>
        </ul>
    </div>
</aside>
