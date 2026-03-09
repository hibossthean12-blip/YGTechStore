<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    /**
     * Display the customer's inbox.
     */
    public function index()
    {
        $messages = ContactMessage::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('inbox', compact('messages'));
    }
}
