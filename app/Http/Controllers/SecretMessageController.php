<?php

namespace App\Http\Controllers;

use App\Models\SecretMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SecretMessageController extends Controller
{
    public function index() {
        $data = [
            
        ];

        return view('client.diary', [
            'title' => 'WeProTech - Diary',
            $data,
        ]);
    }

    public function createSecretMessage(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Create a new secret account
        $secretMessage = new SecretMessage();
        $secretMessage->user_id = $request->user_id;
        $secretMessage->title = Crypt::encryptString($request->title);
        $secretMessage->message = Crypt::encryptString($request->message);
        $secretMessage->save();

        return response()->json(['status' => 'success', 'message' => 'Secret message created successfully'], 200);
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
        // Validate the request data
        $request->validate([
            'id' => 'required|integer|exists:secret_messages,id',
        ]);

        // Find the secret account
        $secretMessage = SecretMessage::find($request->id);

        // Delete the secret account
        $secretMessage->delete();

        return response()->json(['status' => 'success', 'message' => 'Secret message deleted successfully'], 200);
    }
}
