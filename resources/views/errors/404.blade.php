@extends('layouts.guest')

@section('content')
    <div class="d-flex justify-content-start align-items-start me-4 w-100 h-100 pt-5">
        <div class="d-flex flex-column justify-content-start align-items-center h-100 w-50 pt-5">
            <img class="my-5" src="{{Vite::asset('resources/images/dark_logo.png')}}" alt="" style="width: 20vw; height: auto;">
            <p class="mt-2" style="font-weight: 900; font-size: 5rem;">WEPROTECH</p>
        </div>
        <div class="d-flex flex-column justify-content-start align-items-start h-100 pt-5" style="width: 40%;">
            <p class="text-danger mt-5 mb-3" style="font-size: 8rem; font-weight: 900;">Page 404</p>
            <p class="fs-3 my-5">This page is either under construction, not existing, or the admin has not give you permission to access this page.
                If you think this is an error, please contact your administrator. Until then, please proceed.
            </p>
            <a href="javascript:history.back()" class="btn rounded text-white p-3 px-5" style="background-color: #191919;">Go Back</a>
        </div>
    </div>
@endsection