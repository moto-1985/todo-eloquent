<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tasks=Task::orderBy('created_at','desc')->get();
        // $tasks=Task::all();
        // $tasks = Task::with('users')->get();
        // dd($tasks);
        // これ参考にした https://poppotennis.com/posts/laravel-relation-belongstomany
        // 公式は all()の時のデータ取得方法が載ってない　https://readouble.com/laravel/8.x/ja/eloquent-relationships.html
        $user=auth()->user();
        return view('home', compact('tasks', 'user'));
    }
}
