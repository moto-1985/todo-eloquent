### ログイン機能

- ログイン機能の仕組み
    - 1 email password
    - 2 dbと照合
    - 3 セッションに保存(ログイン)
    - 4 セッションを削除(ログアウト)

#### やること
- composerでLaravelをインストール
- debugerとbootstorapを入れる
- 

```
npm install n -g
n stable
apt purge -y nodejs npm
exec $SHELL -l

composer create-project laravel/laravel .
or
composer create-project "laravel/laravel=9.*" .
cd todo-app
composer require barryvdh/laravel-debugbar
composer require laravel/ui:*
or
composer require laravel/ui
php artisan ui bootstrap --auth
apt install nodejs
apt install npm
npm run build
npm install && npm run dev 結局失敗
npm install resolve-url-loader@^5.0.0 --save-dev --legacy-peer-deps　これ打ったらできた
php artisan -V
php artisan serve
git init
git add .
git commit -m "first commit"
```

#### やること
1. Router設定
1. Controller設定
1. viewとBootstrap設定
1. バリデーション設定

1. Router設定
routesのweb.phpを設定
1. Controller設定
php artisan make:controller Auth/AuthController
1. viewとBootstrap設定
assetがpublic配下の意味
1. バリデーション設定
php artisan make:request LoginFormRequest

#### やること
1. Laravelスタータキット
認証機能を自動生成する(scaffold)パッケージ Laravel Breezeを使えばいい ログイン、登録、パスワードリセット、メール確認ができる
1. Authの確認・実装
