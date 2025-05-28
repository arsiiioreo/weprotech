<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
