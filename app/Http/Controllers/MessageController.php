<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:1000',
        ]);

        try {
            Message::create($validated);
            return back()->with('success', 'Your message has been sent successfully!');
        } catch (\Throwable $e) {
            return back()->with('error', 'Failed to send your message. Please try again.');
        }
    }
}
