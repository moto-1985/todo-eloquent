<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    // ステータスを編集画面に返すときに調べたら、この書き方でてきた
    // https://www.kamome-susume.com/laravel-pulldown/
    public function __construct()
    {
        $this->task = new Task();
    }

    public function create() 
    {
        $users = User::all();
        // dd($users);
        return view('task.create', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $inputs = $request->validate([
            'title'=>'required|max:255',
            'content'=>'required|max:255',
            'user_id'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            'attached_file_path'=>'image|max:1024'
        ]);
        $task = new Task();
        $task->title = $inputs['title'];
        $task->content = $inputs['content'];
        $task->user_id = $inputs['user_id'];
        $task->start_date = $inputs['start_date'];
        $task->end_date = $inputs['end_date'];
        // $task->user_id = auth()->user()->id;
        if (request('attached_file_path')){
            $original = request()->file('attached_file_path')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            request()->file('attached_file_path')->move('storage/images', $name);
            $task->attached_file_path = $name;
        }
        $user_id = $inputs['user_id'];
        $task -> save();
        // 多対多の保存　https://poppotennis.com/posts/laravel-relation-belongstomany
        $task->users()->attach($user_id);
        return back()->with('message','タスクを作成しました。');


        return view('task.create');
    }
    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $users = User::all();
        // $tasks = $this->task->get(); // この書き方はマスターテーブルからデータ出すならいいけどここでは使えない
        // return view('task.edit', compact('task', 'users', 'tasks'));
        return view('task.edit', compact('task', 'users'));
    }
    
    public function update(Request $request, Task $task)
    {
        // dd($task->id);
        $inputs = $request->validate([
            'title'=>'required|max:255',
            'content'=>'required|max:255',
            'user_id'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            'status'=>'required',
            'attached_file_path'=>'image|max:1024'
        ]);
        $task->title = $inputs['title'];
        $task->content = $inputs['content'];
        $task->user_id = $inputs['user_id'];
        $task->start_date = $inputs['start_date'];
        $task->end_date = $inputs['end_date'];
        $task->status = $inputs['status'];
        // $task->user_id = auth()->user()->id;
        if (request('attached_file_path')){
            $original = request()->file('attached_file_path')->getClientOriginalName();
             // 日時追加
            $name = date('Ymd_His').'_'.$original;
            request()->file('attached_file_path')->move('storage/images', $name);
            $task->attached_file_path = $name;
        }
        $user_id = $inputs['user_id'];
        $task -> save();
        // 多対多の保存　https://poppotennis.com/posts/laravel-relation-belongstomany
        // 質問 テーブルにあるuserIDとタスクIDを検索して、組み合わせが存在しない時だけ、元あったレコードを削除して、新しいuserIDとタスクIDを追加したい。
        $task->users()->attach($user_id);
        return redirect()->route('tasks.show', $task)->with('message', '投稿を更新しました');

    }

    public function destroy(Task $task)
    {        
        $task->delete();
        return redirect()->route('home')->with('message', '投稿を削除しました');
    }

    public function listBookmark()
    {
        $tasks=Task::orderBy('created_at','desc')->get();
        
        // foreach($a as $task) {
        //   foreach($task->users as $user) {
        //     if ($user->pivot->is_bookmarked === 1) {

        //     }
        //   }
        // }
        // $tasks=Task::where('created_at','desc')->get();
        // $query = Task::query();
        // $query->whereHas('users', function($q)  {
        //     $q->where('is_bookmarked', 1);
        // });
        // dd($query);
        // $tasks=Task::all();
        // $tasks = Task::with('users')->get();
        // dd($tasks);
        // これ参考にした https://poppotennis.com/posts/laravel-relation-belongstomany
        // 公式は all()の時のデータ取得方法が載ってない　https://readouble.com/laravel/8.x/ja/eloquent-relationships.html
        $user=auth()->user();
        return view('home', compact('tasks', 'user'));
    }

    public function updateBookmark(Request $request, Task $task)
    {
        foreach ($task->users as $task_user) {
            if ($task_user->pivot->is_bookmarked === 0 || empty($task_user->pivot->is_bookmarked)) {
                Task::find($task->id)->users()->syncWithPivotValues($task->user_id, ['is_bookmarked' => 1], false);
            } elseif ($task_user->pivot->is_bookmarked === 1) {
                Task::find($task->id)->users()->syncWithPivotValues($task->user_id, ['is_bookmarked' => 0], false);
            }
        }
        return redirect()->route('home', $task);
    }
}
