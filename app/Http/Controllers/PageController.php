<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\SecretAccount;
use App\Models\SecretMessage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    public function getCount()
    {
        $count = Page::count();
        return response()->json(['count' => $count]);
    }

    public function createPage()    
    {
        $response = Http::get('https://ipapi.co/json/')->json();
        // dd($response);
        // $ip = $response['ip'] ?? null;
        $ip = '120.0.0.1';
        $country = $response['country_name'] ?? 'Unknown';

        if ($ip) {
            $lastVisit = Page::where('ip_address', $ip)
                ->orderBy('created_at', 'desc')
                ->first();

            $shouldLog = true;

            if ($lastVisit && now()->diffInMinutes($lastVisit->created_at) < 3) {
                $shouldLog = false;
            }

            if ($shouldLog) {
                $page = new Page();
                $page->ip_address = $ip;
                $page->country = $country;
                $page->save();
            }
        }
        
        // if (Auth::check()) {
        //     // May naka-login!
        //     $user = Auth::user();

        //     dd('Logged in as ' . $user->email);
        // } else {
        //     dd('Walang session or not logged in');
        // }

        $userCount = User::count();
        $accountCount = SecretAccount::count();
        $messageCount = SecretMessage::count();
        $visitorCount = Page::count();
        $loggedIn = Auth::user() ? true : false;

        return view('welcome', [
            'title' => 'WeProTech', 
            'userCount' => $userCount, 
            'accountCount' => $accountCount, 
            'messageCount' => $messageCount, 
            'visitorCount' => $visitorCount,
            'loggedIn' => $loggedIn,
        ]);
    }
}
