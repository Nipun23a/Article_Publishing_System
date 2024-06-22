<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $currentMonth = Carbon::now()->month;
        $articleCount = Article::where('is_published', true)->whereMonth('created_at', $currentMonth)->count();
        $recentArticles = Article::with('user')->where('is_published',true)->orderBy('created_at', 'desc')->take(5)->get();
        return view('admin.dashboard',compact('userCount', 'articleCount', 'recentArticles'));
    }
    public function allUsers()
    {
        // Fetch all users
        $users = User::all();

        // Return the view with the list of users
        return view('admin.users.index', compact('users'));
    }
}
