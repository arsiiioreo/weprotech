<?php

namespace App\Http\Controllers;

use App\Models\AuditLogs;
use App\Models\SecretPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SecretPasswordController extends Controller
{

    public function setPassword(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'vault_password' => 'required|string|confirmed|min:6',
        ], [
            'vault_password.min' => 'Passwords must be atleast 6 characters.',
            'vault_password.confirmed' => 'Passwords do not match.',
        ]);

        if($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('vaultPasswordModal', true)
                ->withErrors($validator->errors());
        }

        $hashedPassword = bcrypt($request->vault_password);
        // $hashedPassword = $request->vault_password;

        if($hashedPassword) {
            $user = User::find(Auth::id());
            $user->vault_password = $hashedPassword;
            $user->save();
            
            AuditLogs::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'text' => 'Vault Password has been set.'   
            ]);
            
            return redirect()->route('home')
                ->with('type', 'success')
                ->with('message', 'Vault password has been set successfully!');
        } else {
            return redirect()->back()
                ->with('type', 'error')
                ->with('message', 'Error setting up vault password. Please try again.');
        }
    }

    public function verifyPassword(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $validator = Validator::make($data, [
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'error',
                'message' => 'Invalid input: ' . $validator->errors()->first()
            ], 422);
        }

        $password = $data['password'];

        $user = User::find(Auth::id());
        if (!$user) {
            return response()->json([
                'type' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        // Verify password
        if (password_verify($password, $user->vault_password)) {
            return response()->json([
                'type' => 'success',
                'message' => 'Password verified successfully'
            ], 200);
        }

        return response()->json([
            'type' => 'error',
            'message' => 'Incorrect password'
        ], 401);
    }


    public function changePassword(Request $request)
    {
        $user = User::find(Auth::id());
        $request->validate([
            'vault_password' => 'string|required|max:255|min:6',
            'vault_new_password' => 'required|string|min:6|confirmed',
        ]);

        if(password_verify($request->vault_password, $user->vault_password)) {
            $user->vault_password = bcrypt($request->vault_new_password);
            $user->save();

            AuditLogs::create([
                'user_id' => Auth::id(),
                'action' => 'edit',
                'text' => 'Vault Password updated',
            ]);
    
            return back()->with('message', 'Vault password updated successfully.')->with('type', 'success');
        }

        return back()->with('message', 'Error changing vault password, please try again.')->with('type', 'error');
    }
}
