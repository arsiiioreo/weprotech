@extends('layouts.app')

@section('content')
<x-header header="Welcome home, {{ $title }}"/>
<x-vault-set-up/>

<style>
  .dashboard-card {
    position: relative;
    overflow: hidden;
    border: none;
    transition: transform 0.2s ease;
    border-radius: 1rem;
  }

  .dashboard-card:hover {
    transform: scale(102%);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
  }

  .dashboard-svg-bg {
    position: absolute;
    z-index: 0;
    opacity: 0.2;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
  }

  .dashboard-card-body {
    position: relative;
    z-index: 1;
    height: 100%;
  }
</style>

<div class="container py-4">
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

    @php
        $cards = [
            'accounts' => [
                'title' => 'Accounts',
                'text' => 'total accounts secured',
                'data' => $totalAccounts,
                'route' => '/accounts',
                'color1' => '#87CEFA',
                'color2' => '#00BFFF',
                'icon' => 'bi-person'
            ],
            'secrets' => [
                'title' => 'Secrets',
                'text' => 'total secrets in the vault',
                'data' => $totalSecrets,
                'route' => '/secrets',
                'color1' => '#FF7F50',
                'color2' => '#FF4500',
                'icon' => 'bi-lock'
            ],
            'logs' => [
                'title' => 'Activity Logs',
                'text' => 'total transaction history',
                'data' => 32,
                'route' => '/logs',
                'color1' => '#A8E6CF',
                'color2' => '#DCEDC1',
                'icon' => 'bi-clock-history'
            ],
        ];
    @endphp

    @foreach ($cards as $key => $item)
    <div class="col">
      <a href="{{ $item['route'] }}" style="text-decoration: none;">
        <div class="card dashboard-card shadow-sm"
             style="background: linear-gradient(to right, {{ $item['color1'] ?? '#ffffff' }}, {{ $item['color2'] ?? $item['color1'] ?? '#eeeeee' }});">
          
          <svg class="dashboard-svg-bg" viewBox="0 0 900 600" preserveAspectRatio="none">
            <g transform="translate(900, 0)">
              <path d="M0 486.7C-66.7 478.4 -133.4 470 -181 437C-228.6 404 -257.2 346.5 -304.1 304.1C-350.9 261.7 -416.2 234.4 -449.7 186.3C-483.2 138.1 -485 69.1 -486.7 0L0 0Z"
                    fill="#ffffff"/>
            </g>
            <g transform="translate(0, 600)">
              <path d="M0 -486.7C65.8 -477.7 131.6 -468.7 181.4 -437.9C231.2 -407.1 265 -354.5 311.8 -311.8C358.6 -269.2 418.4 -236.6 449.7 -186.3C481 -136 483.9 -68 486.7 0L0 0Z"
                    fill="#ffffff"/>
            </g>
          </svg>

          <div class="card-body dashboard-card-body d-flex flex-column justify-content-between p-4">
            <div class="d-flex mb-0 justify-content-between">
                <p class="fw-semibold mb-0 fs-5">{{ $item['title'] }}</p>
                <i class="bi {{ $item['icon'] }} fs-2 text-dark"></i>
            </div>
            <h1 class="fw-bold text-dark align-self-start mb-0 mt-4">{{ $item['data'] ?? 0 }}</h1>
            <p class="text-muted mb-0 fs-6">{{ $item['text'] }}</p>
          </div>
        </div>
      </a>
    </div>
    @endforeach

  </div>
</div>

<div class="col p-3">
    <h5 class="card-title fw-semibold mt-5 mb-4">Do you have an account to secure?</h5>
    <a href="/diary" style="text-decoration: none;">
        <div class="card shadow-sm border-0 p-3 rounded-4 d-flex align-items-center flex-row gap-3" style="transition: 0.3s; cursor: pointer;">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=191919&color=fff&size=64"
                alt="Profile" class="rounded-circle" width="50" height="50">
            <p class="form-control border-0 bg-light rounded-pill ps-4 py-2 my-1"> Let's not forget our passwords, secure it now {{ explode(' ', Auth::user()->name)[0] }}!</p>
            <i class="bi bi-lock-fill fs-5"></i>
        </div>
    </a>
    <h5 class="card-title fw-semibold mt-5 mb-4">Do you have a secret to share?</h5>
    <a href="/diary" style="text-decoration: none;">
        <div class="card shadow-sm border-0 p-3 rounded-4 d-flex align-items-center flex-row gap-3" style="transition: 0.3s; cursor: pointer;">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=191919&color=fff&size=64"
                alt="Profile" class="rounded-circle" width="50" height="50">
            <p class="form-control border-0 bg-light rounded-pill ps-4 py-2 my-1">What's on your mind, {{ explode(' ', Auth::user()->name)[0] }}</p>
            <i class="bi bi-pencil-fill fs-5"></i>
        </div>
    </a>
</div>


@endsection
