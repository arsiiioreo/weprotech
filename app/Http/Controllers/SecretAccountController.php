<?php

namespace App\Http\Controllers;

use App\Models\AuditLogs;
use App\Models\SecretAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class SecretAccountController extends Controller
{
    public $data = [];

    public function index() {
        $secretAccounts = SecretAccount::where('user_id', Auth::id())
        ->where('isDeleted', '0')
        ->orderBy('created_at', 'desc')
        ->get();

        // Decrypt the sensitive data
        foreach ($secretAccounts as $account) {
            $account->account_name = Crypt::decryptString($account->account_name);
            $account->account_email = Crypt::decryptString($account->account_email);
            $account->password = $account->password;
            $account->created_at_human = $account->created_at->diffForHumans();
        }

        $this->data = $secretAccounts;
        // dd($this->data);

        return view('client.accounts', [
            'title' => 'WeProTech - Accounts',
            'accounts' => $secretAccounts
        ]);
    }

    public function createSecretAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_email' => 'required|string|email|max:255',
            'password' => 'required|string|confirmed|min:6',
        ], [
            'password.confirmed' => 'Passwords do not match.',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return redirect()->back()
            ->withInput()
            ->with('add', true)
            ->withErrors($validator->errors());
        }

        try {
            $secretAccount = new SecretAccount();
            $secretAccount->user_id = Auth::id();
            $secretAccount->category = $request->category;
            $secretAccount->account_name = Crypt::encryptString($request->account_name);
            $secretAccount->account_email = Crypt::encryptString($request->account_email);
            $secretAccount->password = Crypt::encryptString($request->password);
            $secretAccount->save();

            return redirect()->back()
            ->with('type', 'success')
            ->with('message', 'Secret Account successfully saved.');
        } catch (\Exception $e) {
            // Catch any server-side error (ex. DB connection fail, etc.)
            return redirect()->back()
            ->with('type', 'error')
            ->with('message', 'An error occurred while saving the account.');
        }
    }

    public function getSecretAccount($id)
    {
        $account = SecretAccount::findOrFail($id);

        session()->flash('showAccountModal', true); 

        session()->flash('secretAccount', [
            'category' => $account->category,
            'account_name' => Crypt::decryptString($account->account_name),
            'account_email' => Crypt::decryptString($account->account_email),
            'password' => $account->password,
            'passwordDecoded' => Crypt::decryptString($account->password),
        ]);

        return redirect()->back();
    }

    public function openEditAccountModal($id)
    {
        $account = SecretAccount::findOrFail($id);
        session()->flash('showAccountModalEdit', true); 

        $editAccount = [
            'id' => $account->id,
            'category' => $account->category,
            'account_name' => Crypt::decryptString($account->account_name),
            'account_email' => Crypt::decryptString($account->account_email),
            'password' => Crypt::decryptString($account->password),
        ];

        session()->put('dataEdit', $editAccount);

        return redirect()->back()->with('dataEdit', $editAccount); // Renders with modal open and data
    }



    // public function getAllSecretAccount(Request $request)
    // {
    //     // Retrieve all secret accounts for the user
    //     $secretAccounts = SecretAccount::where('user_id', $request->user_id)->get();

    //     // Decrypt the sensitive data
    //     foreach ($secretAccounts as $account) {
    //         $account->account_name = Crypt::decryptString($account->account_name);
    //         $account->account_email = Crypt::decryptString($account->account_email);
    //         $account->password = Crypt::decryptString($account->password);
    //     }

    //     return response()->json(['status' => 'success', 'data' => $secretAccounts], 200);
    // }

    public function updateSecretAccount(Request $request)
    {
        // Validate the request data
        $validator=Validator::make($request->all(), [
            'category' => 'string|required|max:255',
            'account_name' => 'string|required|max:255',
            'account_email' => 'string|required|email|max:255',
            'old_password' => 'string|required|max:255',
            'new_password' => 'string|max:255|confirmed',
        ]);
        // dd('in cont');

        // Update the secret account
        $secretAccount = SecretAccount::findOrFail($request->id);
        // dd($secretAccount);
        if(Crypt::decryptString($secretAccount->password) == $request->old_password) {
            // dd('Im in');
            if($request->category) {
                $secretAccount->category = $request->category;
            }
            if($request->account_name) {
                $secretAccount->account_name = Crypt::encryptString($request->account_name);
            }
            if($request->account_email) {
                $secretAccount->account_email = Crypt::encryptString($request->account_email);
            }
            if($request->new_password) {
                $secretAccount->password = Crypt::encryptString($request->new_password);
            }
            $secretAccount->save();
            session()->forget('editAccount');

            return redirect()->back()
            ->with('type', 'success')
            ->with('message', 'Secret Account successfully updated.');
        } else {
            return redirect()->back()
                ->with('type', 'error')
                ->with('message', 'Error wrong password.');
        }

        if($validator->fails()) {
            return redirect()->back()
            ->with('type', 'error')
            ->with('message', $validator->errors());
        }
    }

    public function deleteSecretAccount($id)
    {

        // Delete the secret account
        $secretAccount = SecretAccount::find($id);
        $secretAccount->isDeleted = '1';
        $secretAccount->save();

        return redirect()->back()
            ->with('type', 'success')
            ->with('message', 'Secret Account successfully deleted.');
    }
}
