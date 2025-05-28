@extends('layouts.app')

@section('content')
<x-header header='Profile'/>
<div class="w-100 text-center">
    <i class="bi bi-person-circle" style="font-size: 5rem;"></i>
    <span>
        @php
            $user = [
                'name' => Auth::user()->name,
                'username' => Auth::user()->username,
                'email' => Auth::user()->email,
                'created_at' => Auth::user()->created_at->format('d M Y'),
            ];
            use App\Models\SecretAccount;
            $secret = SecretAccount::where('user_id', Auth::id())->get();
        @endphp
        <div class="fs-1 fw-bold">{{ $user['name'] }}</div>
        <div class="fs-5">{{ '@' . $user['username'] }}</div>
        {{$secret}}
    </span>
</div>
@endsection
