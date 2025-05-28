<?php

namespace App\Http\Controllers;

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

        $hashedPassword = bcrypt($request->password);

        $user = User::find(Auth::id());
        $user->vault_password = $hashedPassword;
        $user->save();


        return redirect()->route('home')
            ->with('type', 'success')
            ->with('message', 'Vault password set successfully!');
    }

    public function verifyPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        if(Auth::id()) {
            $secretPassword = User::find(Auth::id())->first();
    
            if ($secretPassword && password_verify($request->password, $secretPassword->vault_password)) {
                return response()->json(['type' => 'success', 'message' => 'Password verified successfully'], 200);
            }
        }
        // // Validate the request data


        // return response()->json(['type' => 'error', 'message' => 'Incorrect password'], 401);
    }

    public function changePassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $secretPassword = SecretPassword::where('user_id', $request->user_id)
            ->first();

        if ($secretPassword) {
            $secretPassword->password = bcrypt($request->new_password);
            $secretPassword->save();

            return response()->json(['status' => 'success', 'message' => 'Password changed successfully'], 200);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid old password'], 401);
    }
}
