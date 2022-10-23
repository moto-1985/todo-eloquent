<div class="list-group"> 
    <a href="{{route('home')}}"
    class="list-group-item {{url()->current()==route('home')? 'active' : ''}}">
        <i class="fas fa-home pr-2"></i><span>全タスク一覧</span>
    </a>
    <a href="{{route('tasks.create')}}"
    class="list-group-item {{url()->current()==route('tasks.create')? 'active' : ''}}">
        <i class="fas fa-pen-nib pr-2"></i><span>新規投稿</span>
    </a>
    <a href="{{route('tasks.bookmark')}}"
    class="list-group-item {{url()->current()==route('tasks.bookmark')? 'active' : ''}}">
        <i class="fa-sharp fa-solid fa-book pr-2"></i><span>ブックマーク</span>
    </a>
    <a href="{{route('tasks.bookmark')}}"
    class="list-group-item {{url()->current()==route('tasks.bookmark')? '' : ''}}">
        <i class="fa-sharp fa-solid fa-list-check pr-2"></i><span>自分のタスク</span>
    </a>
</div>