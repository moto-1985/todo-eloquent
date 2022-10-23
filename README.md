#### うったコマンド
composer create-project "laravel/laravel=8.*" .
composer require laravel/ui:*
php artisan ui bootstrap --auth
npm install && npm run dev
npm install resolve-url-loader@^5.0.0 --save-dev --legacy-peer-deps
npm install && npm run dev
php artisan make:model Task -m
php artisan make:model TaskUser -m

#### app.php
'timezone' => 'Asia/Tokyo',
'locale' => 'ja',

#### 日本語化　zip持ってくる
https://github.com/Laravel-Lang/lang

#### 日本語化　このコマンド打つ
php -r "copy('https://readouble.com/laravel/8.x/ja/install-ja-lang-files.php', 'install-ja-lang.php');"
php -f install-ja-lang.php
php -r "unlink('install-ja-lang.php');"

#### 日本語化確認のためテーブル作る
php artisan migrate // validation.phpを変更するとさらにバリデーションできる
php artisan migrate:rollback

#### RouteServiceProvider.php
protected $namespace = 'App\\Http\\Controllers';
Route::get('/home', [HomeController::class, 'index'])->name('home'); が右のようにかける  Route::get('/home', 'HomeController@index')->name('home');

#### モデルとテーブルを作る
php artisan make:model Task -m
php artisan migrate
php artisan make:model Bookmark -m // php artisan make:model TaskUser -m こんな感じで区切る
php artisan migrate

#### モデルクラスにリレーションを書いた

#### views/task/create.blade.php作成

#### コントローラを作る
php artisan make:controller TaskController
#### ルートを作る
全部のルートを作ってしまおう
#### タスク新規作成から作る createとstoreメソッド

#### views/task/create.blade.php改造
#### 画像登録
php artisan storage:link

#### プルダウンメニューの作り方 configの使い方も載ってる
https://www.kamome-susume.com/laravel-pulldown/

#### 中間テーブルの値更新　　意味がわからない
https://qiita.com/ijohnny/items/a67f3d3c989f82a269a1#%E4%B8%AD%E9%96%93%E3%83%86%E3%83%BC%E3%83%96%E3%83%AB%E3%81%AE%E5%80%A4%E3%82%92%E6%9B%B4%E6%96%B0%EF%BC%88%E6%9C%AC%E9%A1%8C%EF%BC%81%EF%BC%89

#### 中間テーブルの値を取得してくる  foreach ($members->groups as $group) { １つしかデータない場合でもこれでループさせないといけないのが気に食わない
https://biz.addisteria.com/laravel_withpivot/
https://www.nyamucoro.com/entry/2018/02/01/213102

#### リソースコントローラ作成
php artisan make:controller TaskController --resource
// createメソッド内でviews/task/create.blade.phpを呼び出す。
// ルートの設定
Route::resource('/task', 'TaskController');
// Bootstrap4 Datepickerを設定してカレンダーを設定
参考：https://qiita.com/saka212/items/55670d43f4bf6ef070cd

--- ここまででfirst commit

--- ここから続き
#### TaskModelに$fillableを追加
#### TaskControllerのstoreメソッドを定義
#### バリデーションの定義
#### 画像の保存 シンボリックリンク作成
php artisan storage:link
#### 全部のユーザをusersテーブルから取得して表示するようにした
参考：https://readouble.com/laravel/8.x/ja/queries.html
#### タスク一覧画面の作成
#### サイドバーを作成する
#### 削除と編集作成
--- ここまででsecond commit
#### これ参考にする bookmarksテーブルに外部キー制約を入れた
https://laraweb.net/practice/4393/
#### 多対多の関係を定義
--- ここまででthird commit
#### bookmarksテーブルを → user_taskに変更
php artisan migrate:rollback
php artisan make:migration create_tasks_users_table --create=task_user
php artisan migrate
php artisan make:model TaskUser
https://biz.addisteria.com/laravel_withpivot/
#### コントローラーの作成
php artisan make:controller BookmarkController --resource

### これじゃないとダメ　　Base table or view not found: 1146 Table 'todo.task_users' doesn't exist と言われた
task_usersテーブル
php artisan make:model TaskUser -m
php artisan migrate:rollback --step=1
