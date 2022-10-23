@extends('layouts.app')
@section('content')
@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif

{{$user->name}}さん、こんにちは！
@foreach ($tasks as $task)
<div class="container-fluid mt-20" style="margin-left:-10px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="media flex-wrap w-100 align-items-center">
                        <div class="media-body ml-3"><a href="{{route('tasks.show', $task)}}"> タスクタイトル：{{ $task->title }}</a>
                        @foreach ($task->users as $task_user)
                            <div class="text-muted small"> 担当者：{{ $task_user->name }}</div>
                        @endforeach
                        </div>
                        <div class="text-muted small ml-3">
                            <div>作成日</div>
                            <div><strong>{{$task->created_at->diffForHumans()}}</strong> </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p>タスクの内容：{{$task->content}}</p>
                    <p> タスクのステータス：{{config("task.task_status." . $task->status)}} </p>
                    <p> {{isset($task->attached_file_path)? "添付ファイル名：" . $task->attached_file_path : '添付ファイルなし'}}</p>
                    <p> 開始日：{{$task->start_date}} </p>
                    <p> 終了日：{{$task->end_date}} </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection