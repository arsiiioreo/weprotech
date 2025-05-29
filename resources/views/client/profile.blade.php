@extends('layouts.app')

@section('content')
<x-header header='Profile'/>

<style>
    span.badge {
        text-transform: capitalize;
        color: white;
    }
    
    span.badge.login {
        background-color: green;
    }
    
    span.badge.logout {
        background-color: #191919;
        color: #fff;
    }
    
    span.badge.click {
        background-color: #c56110;
        color: #fff;
    }

    span.badge.create{
        background-color: blue;
    }

    span.badge.edit {
        background-color: yellow;
        color: #191919;
    }

    span.badge.delete {
        background-color: red;
    }
</style>

<div class="container py-4">
    {{-- Profile Card --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body text-center">
            <i class="bi bi-person-circle text-secondary" style="font-size: 6rem;"></i>
            <h3 class="fw-bold mt-3 mb-0">{{ Auth::user()->name }}</h3>
            <p class="text-muted fs-5">{{ '@' . Auth::user()->username }}</p>

            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="d-flex justify-content-between text-start mb-2">
                        <span class="fw-semibold">Email:</span>
                        <span class="text-muted text-end">{{ Auth::user()->email }}</span>
                    </div>
                    <div class="d-flex justify-content-between text-start mb-2">
                        <span class="fw-semibold">Member Since:</span>
                        <span class="text-muted text-end">{{ Auth::user()->created_at->format('F d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Activity Logs --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5 class="mb-0 fw-bold p2-3 d-flex align-items-center">
                <i class="bi bi-clock-history me-3 fs-2"></i>
                Activity History
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="scrollable-logs overflow-y-auto" style="max-height: 400px;">
                @if($history->count())
                    <ul class="list-group list-group-flush">
                        @foreach($history as $log)
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <div class="ms-2 me-auto">
                                    <div class="fw-semibold">
                                        {{ $log->text }}
                                    </div>
                                    <small class="text-muted">
                                        {{ $log->created_at->format('M d, Y - h:i A') }}
                                    </small>
                                </div>
                                <span class="badge border    shadow-sm {{$log->action}}">
                                    {{ $log->action ?? 'Null'}}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="p-4 text-center text-muted">
                        <i class="bi bi-emoji-frown fs-1 d-block mb-3"></i>
                        No activity logs found.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
