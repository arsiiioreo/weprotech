@extends('layouts.app')

@section('content')
<x-header header='Settings'/>

@php
    $tabs = [
        'profile' => ['name' => 'Profile'],
        'password' => ['name' => 'Vault Password'],
        // Add more tabs here kung gusto mo
    ];
@endphp

@php
  use Jenssegers\Agent\Agent;
  $agent = new Agent();
@endphp
@if ($agent->isMobile())
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded-2">
        <div class="container-fluid">

            <!-- Toggler button for mobile -->
            <button class="navbar-toggler text-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-lg-flex" id="settings-tabs">
                    @foreach ($tabs as $key => $tab)
                        <li class="nav-item">
                            <a 
                                class="nav-link {{ $loop->first ? 'navActive' : '' }}" 
                                href="javascript:void(0);" 
                                data-tab="{{ $key }}"
                            >
                                {{ $tab['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <div id="tab-content" class="p-3 bg-body-tertiary mt-3 rounded-2 overflow-auto">
        <div class="settings-tab-content" data-content="profile" style="display: block;">
            @include('client.settings.profile')
        </div>

        <div class="settings-tab-content" data-content="password" style="display: none;">
            @include('client.settings.password')
        </div>
    </div>

@else

    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded-2">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="settings-tabs">
                    @foreach ($tabs as $key => $tab)
                        <li class="nav-item">
                            <a 
                                class="nav-link {{ $loop->first ? 'navActive' : '' }}" 
                                href="javascript:void(0);" 
                                data-tab="{{ $key }}"
                            >
                                {{ $tab['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <div id="tab-content" class="p-3 bg-body-tertiary mt-3 rounded-2 overflow-auto">
        <div class="settings-tab-content" data-content="profile" style="display: block;">
            @include('client.settings.profile')
        </div>

        <div class="settings-tab-content" data-content="password" style="display: none;">
            @include('client.settings.password')
        </div>
    </div>
@endif








<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('#settings-tabs .nav-link');
        const contents = document.querySelectorAll('.settings-tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove 'active' class from all tabs
                tabs.forEach(t => t.classList.remove('navActive'));
                tab.classList.add('navActive');

                // Show the right content, hide others
                const target = tab.getAttribute('data-tab');
                contents.forEach(content => {
                    if (content.getAttribute('data-content') === target) {
                        content.style.display = 'block';
                    } else {
                        content.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endsection
