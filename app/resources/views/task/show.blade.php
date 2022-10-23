@extends('layouts.app')
@section('content')
<h4 class="mt4">タスク詳細</h4>
@if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
@endif
<div class="card mb-4">
    <div class="card-header">
        <h5>タスクタイトル：{{$task->title}}</h5>
        <span class="ml-auto">
        <a href="{{route('tasks.edit', $task)}}"><button class="btn btn-primary">編集</button></a>
        </span>
        <span class="ml-2">
          <form method="post" action="{{route('tasks.destroy', $task)}}">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger" onClick="return confirm('本当に削除しますか？');">削除</button>
          </form>
        </span>
        <div class="text-muted small mr-3">
        @foreach ($task->users as $task_user)
            <div class="text-muted small"> 担当者：{{ $task_user->name }}</div>
        @endforeach
        </div>
    </div>
    <div class="card-body">
        <p class="card-text">
        タスクの内容：{{$task->content}}
        </p>
        @if($task->attached_file_path)
        <div>
            <img src="{{ asset('storage/images/'.$task->attached_file_path)}}" 
            class="img-fluid mx-auto d-block" style="height:300px;">
            (添付ファイル名：{{$task->attached_file_path}})
        </div>
        @endif
        <p> タスクのステータス：{{config("task.task_status." . $task->status)}} </p>
        <p class="mt-3"> 開始日：{{$task->start_date}} </p>
        <p> 終了日：{{$task->end_date}} </p>
    </div>
    <div class="card-footer">
        <span class="mr-2 float-right">
            作成日 {{$task->created_at->format('Y/m/d H:i:s')}}
        </span>
    </div>
</div>

@endsection