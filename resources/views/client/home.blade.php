@extends('layouts.app')

@section('content')
<x-header header='Welcome home, {{$title}}?'/>
<x-vault-set-up/>
<div class="d-flex justify-content-evenly w-100">
    <div class="d-flex align-items-center justify-content-center">
        <div class="card text-center box-shadow" style="width: 18rem;">
            <h5 class="card-title">Total Accounts</h5>
            <h5 class="card-title">{{$user}}</h5>
        </div>
    </div>
</div>
@endsection
