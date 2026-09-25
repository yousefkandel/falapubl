<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Translator;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'active_books' => Book::where('status', 1)->count(),
            'total_authors' => Author::count(),
            'total_translators' => Translator::count(),
            'total_users' => User::count(),
        ];

        $recentBooks = Book::with(['author', 'translator'])
            ->latest()
            ->take(6)
            ->get();

        $latestUsers = User::latest()->take(5)->get();

        return view('admin.dashboard.index', compact('stats', 'recentBooks', 'latestUsers'));
    }
}
