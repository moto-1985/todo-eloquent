@extends("layouts.app")
@section("content")

<div class="row">
    <div class="col-md-10 mt-6">
        <div class="card-body">
            <h4 class="mt4">タスク編集</h4>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form enctype="multipart/form-data" action="{{route('tasks.updateBookmark', $task)}}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" value="{{old('title', $task->title)}}">
                </div>

                <div class="form-group">
                    <label for="content">タスクの内容</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="10">{{old('content', $task->content)}}</textarea>
                </div>

                <!--  ステータスプルダウン -->
                <div class="form-group mt-3">
                  <label for="status">{{ __('ステータス') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
                  <select class="form-control" id="status" name="status">
                      @foreach (Config::get('task.task_status') as $key => $val)
                          <option value="{{ $key }}">{{ $val }}</option>
                      @endforeach
                  </select>
                </div>

                <div class="form-group">
                    <label for="attached_file_path">添付ファイル(1MBまで)</label>
                    <div class="col-md-6">
                        <input id="attached_file_path" type="file" name="attached_file_path">
                    </div>
                </div>

                <div class="form-group">
                    <label for="user">担当者</label>
                    <select class="form-control" id="user" name="user_id">
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-daterange input-group" id="datepicker">
                    <div class="input-group-prepend">
                        <span class="input-group-text">開始日付</span>
                        <input type="text" class="input-sm form-control" name="start_date" value="{{old('start_date', $task->start_date)}}">
                    </div>

                    <div class="input-group-append">
                      <span class="input-group-text">終了日付</span>
                    </div>
                    <input type="text" class="input-sm form-control" name="end_date" value="{{old('end_date', $task->end_date)}}">
                </div>

                <div>
                    <button type="submit" class="btn btn-success mt-3">送信する </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection