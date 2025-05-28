<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $user = Auth::user()?->id ?? 'No user';

        return view('client.home', [
            'title' => 'WeProTech - Home',
            'user' => $user,
        ]);
    }
}
