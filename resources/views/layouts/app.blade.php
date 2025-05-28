<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-head :title="$title"/>
    <body class="d-flex align-items-center vh-100" style="background-color: #191919;">
        
        @include('components.side-bar')

        @if(Auth::check() && is_null(Auth::user()->vault_password))
            @include('components.vault-set-up')
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const modal = new bootstrap.Modal(document.getElementById('vaultPassword'));
                    modal.show();                    
                });
            </script>
        @endif

        @if(session('message'))
            <script>
                window.addEventListener('load', function () {
                    messageToast(@json(session('message')), @json(session('type') ?? 'success'));
                });
            </script>
        @endif

        <main class="d-flex justify-content-start align-items-center w-100 p-4 ps-0" style="height: 100vh">
            <div class="bg-white rounded-4 d-flex flex-column p-4 w-100 h-100 overflow-auto">
                @yield('content')
            </div>
        </main>
    </body>
    @stack('scripts')
</html>

