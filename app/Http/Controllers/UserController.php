<?php

namespace App\Http\Controllers;

use App\Models\AuditLogs;
use App\Models\SecretPassword;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function createAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'username.unique' => 'Username already taken.',
            'email.unique' => 'Email already registered.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Passwords do not match.',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            // move "confirmed" error from `password` to `password_confirmation`
            if ($errors->has('password')) {
                $messages = $errors->get('password');
                foreach ($messages as $message) {
                    if (str_contains($message, 'match')) {
                        $errors->add('password_confirmation', 'Passwords do not match, pleaser re-enter.');
                    }
                }
            }

            return back()
                ->withErrors($errors)
                ->withInput()
                ->with('showRegistrationModal', true);
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        
        Auth::login($user);
        AuditLogs::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'text' => 'Account created.'
        ]);
        return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'Account created successfully!');
    }


    public function login(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'user' => 'required|string',
            'password' => 'required|string',
        ]);
        // Try to find the user by email or username
        $user = User::where('email', $request->user)
        ->orWhere('username', $request->user)
        ->first();
        
        if ($user && password_verify($request->password, $user->password)) {
            // dd('nakarating ka rin');
            Auth::login($user); // 
            AuditLogs::create([
            'user_id' => Auth::id(),
            'action' => 'login',
            'text' => 'User logged in.'
            ]);
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME); 
        }

        if ($user) {
            return back()
                ->withInput() // keep input except password
                ->withErrors(['password' => 'Incorrect password. Please try again.'])
                ->with('showLoginModal', true);
        }

        return back()
            ->withInput()
            ->withErrors(['user' => 'User not found.'])
            ->with('showLoginModal', true);
    }


    public function resetPassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $query = $request->input('query');

        // Find the user by email
        $user = User::where('username', $query)
            ->orWhere('email', $query)
            ->first();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }

        // Update the user's password
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['status' => 'success', 'message' => 'Password changed successfully'], 200);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'string|max:255',
            'old_password' => 'string|max:255',
        ]);

        $user = User::find(Auth::id());

        if(password_verify($request->old_password, $user->password)) {
            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
            }
            
    
    
            if($request->name) {
                $user->name = $request->name;
            }
            
            if($request->username) {
                if($request->username !== $user->username) {
                    $request->validate([
                        'username' => 'string|max:255|unique:users,username',
                    ]);
                }
                 
                $user->username = $request->username;
            }
    
            if($request->email) {
                if($request->email !== $user->email) {
                    $request->validate([
                        'email' => 'string|email|max:255|unique:users,email',
                    ]);
                }
                $user->email = $request->email;
            }
    
            if($request->new_password) {
                $request->validate([
                    'new_password' => 'string|max:255|confirmed',
                ]);
                $user->password = bcrypt($request->new_password);
            }
            $user->save();
            AuditLogs::create([
            'user_id' => Auth::id(),
            'action' => 'edit',
            'text' => 'Updated Profile.'   
            ]);
    
            return back()->with('message', 'Profile updated successfully.')->with('type', 'success');
        } else {
            return back()->withInput()->with('message', 'Wrong password, please try again.')->with('type', 'error');
        }

    }

    public function changePassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        // Find the user by ID
        $user = User::find($request->id);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }

        // Check if the old password is correct
        if (!password_verify($request->old_password, $user->password)) {
            return response()->json(['status' => 'error', 'message' => 'Old password is incorrect'], 401);
        }

        // Update the user's password
        $user->password = bcrypt($request->new_password);
        $user->save();

        return response()->json(['status' => 'success', 'message' => 'Password changed successfully'], 200);
    }
    
    public function deleteAccount(Request $request)
    {
        // Find the user by ID
        $user = User::find($request->id);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }

        // Delete the user
        $user->delete();

        return response()->json(['status' => 'success', 'message' => 'Account deleted successfully'], 200);
    }

    public function logout(Request $request)
    {
        AuditLogs::create([
            'user_id' => Auth::id(),
            'action' => 'logout',
            'text' => 'User logged out.'
        ]);
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/')
            ->with('type', 'success')
            ->with('message', 'Logged out successfully.');
    }
}
