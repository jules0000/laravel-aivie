<?php

namespace App\Http\Controllers;

use App\Models\DiaryEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        DiaryEntry::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'is_anonymous' => true,
        ]);

        return redirect()->back()->with('success', 'Your message has been submitted anonymously!');
    }

    public function myStories()
    {
        $entries = DiaryEntry::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('diary.my-stories', compact('entries'));
    }
}

