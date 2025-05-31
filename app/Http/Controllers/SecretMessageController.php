<?php

namespace App\Http\Controllers;

use App\Models\AuditLogs;
use App\Models\SecretMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class SecretMessageController extends Controller
{
    public function index() {
        $diaries = SecretMessage::where('user_id', Auth::id())
        ->where('isDeleted', '0')
        ->orderBy('created_at', 'desc')
        ->get();

        foreach($diaries as $diary) {
            $diary->title = Crypt::decryptString($diary->title);
            $diary->messageDecrypted = Crypt::decryptString($diary->message);
            $diary->created_at_human = $diary->created_at->diffForHumans();
        }

        return view('client.diary', [
            'title' => 'WeProTech - Diary',
            'diaries' => $diaries,
        ]);
    }

    public function createSecretMessage(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'message' => 'required|string',
       ]);

       if ($validator->fails()) {
            return redirect()->back()
            ->withInput()
            ->with('diaryModal', true)
            ->withErrors($validator->errors());
        }

        // Create a new secret account
        $secretMessage = new SecretMessage();
        $secretMessage->user_id = Auth::id();
        $secretMessage->title = Crypt::encryptString($request->title);
        $secretMessage->message = Crypt::encryptString($request->message);
        $secretMessage->save();
        AuditLogs::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'text' => 'Created a diary.'   
            ]);

        return redirect()->back()
            ->with('type', 'success')
            ->with('message', 'Diary successfully saved.');
    }

    public function getSecretMessage(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id' => 'required|integer|exists:secret_messages,id',
        ]);

        // Retrieve the secret account
        $secretMessage = SecretMessage::find($request->id);

        // Decrypt the sensitive data
        $secretMessage->title = Crypt::decryptString($secretMessage->title);
        $secretMessage->message = Crypt::decryptString($secretMessage->message);

        return response()->json(['status' => 'success', 'data' => $secretMessage], 200);
    }

    public function getAllSecretMessage(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);

        // Retrieve all secret accounts for the user
        $secretMessages = SecretMessage::where('user_id', $request->user_id)->get();

        // Decrypt the sensitive data
        foreach ($secretMessages as $secretMessage) {
            $secretMessage->title = Crypt::decryptString($secretMessage->title);
            $secretMessage->message = Crypt::decryptString($secretMessage->message);
        }

        return response()->json(['status' => 'success', 'data' => $secretMessages], 200);
    }

    public function updateSecretMessage(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id' => 'required|integer|exists:secret_messages,id',
            'title' => 'string|max:255',
            'message' => 'string',
        ]);

        // Find the secret account
        $secretMessage = SecretMessage::find($request->id);

        // Update the secret account
        if ($request->has('title')) {
            $secretMessage->title = Crypt::encryptString($request->title);
        }
        if ($request->has('message')) {
            $secretMessage->message = Crypt::encryptString($request->message);
        }
        $secretMessage->save();

        return response()->json(['status' => 'success', 'message' => 'Secret message updated successfully'], 200);
    }

    public function deleteSecretMessage(Request $request)
    {
        $secretMessage = SecretMessage::find($request->id);
        $secretMessage->isDeleted = '1';
        $secretMessage->save();
        AuditLogs::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'text' => 'Deletd a diary.'
        ]);

        return back()->with('message', 'Diary successfully deleted.')->with('type', 'success');
    }
}
