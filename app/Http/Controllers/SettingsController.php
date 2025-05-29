<?php

namespace App\Http\Controllers;

use App\Models\AuditLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index() {
        $data = [
            
        ];

        return view('client.settings', [
            'title' => 'WeProTech - Settings',
            $data,
        ]);
    }
}
