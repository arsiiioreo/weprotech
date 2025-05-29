<?php

namespace App\Http\Controllers;

use App\Models\SecretAccount;
use App\Models\SecretMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $user = Auth::user()?->id ?? 'No user';

        return view('client.home', [
            'title' => 'WeProTech - Home',
            'user' => $user,
            'totalAccounts' => SecretAccount::where('user_id', Auth::id())->count(),
            'totalSecrets' => SecretMessage::where('user_id', Auth::id())->count(),
        ]);
    }
}
