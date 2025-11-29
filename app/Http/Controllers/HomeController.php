<?php

namespace App\Http\Controllers;

use App\Models\DiaryEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $userEntries = null;
        if (Auth::check()) {
            $userEntries = DiaryEntry::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        }

        // Get anonymous diary entries for public display
        $anonymousEntries = DiaryEntry::where('is_anonymous', true)
            ->orderBy('created_at', 'desc')
            ->limit(12)
            ->get();

        return view('welcome', compact('userEntries', 'anonymousEntries'));
    }
}

