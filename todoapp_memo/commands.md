環境構築参考リンク DockerとLaravelのインストール
https://www.engilaboo.com/laravel-nginx-docker/


https://biz.addisteria.com/laravel9_vite_server_trouble/
---
#### うったコマンド
``` bash
docker-compose up -d
docker-compose exec app bash
cd /var/www/app
composer create-project laravel/laravel .
```

---
#### 先にログインを作ってみよう
https://www.youtube.com/watch?v=t5PPCfcpq4A

準備コマンド
``` bash
composer require barryvdh/laravel-debugbar
composer require laravel/ui
php artisan ui bootstrap
apt install nodejs
apt install npm
npm install && npm run dev #npm run dev失敗する
```

タイムゾーンとローケーション設定
    'timezone' => 'Asia/Tokyo',
    'locale' => 'ja',

#### DB設計をもとにマイグレーションファイル、Eloquentファイルを作る
```
php artisan make:model User -m
php artisan make:model Bookmark -m
php artisan make:model Task -m

```