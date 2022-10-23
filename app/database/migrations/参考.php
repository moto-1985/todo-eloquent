<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskUsersTable extends Migration
{

    // 質問task_userテーブルにならない
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('task_id');
            $table->boolean('is_assigned')->nullable();
            $table->boolean('is_bookmarked')->nullable();

            $table->timestamps();

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }
    // CREATE TABLE IF NOT EXISTS `bookmarks` (
    //     `id` bigint(16) unsigned NOT NULL AUTO_INCREMENT,
    //     `user_id` bigint(16) unsigned NOT NULL COMMENT 'ユーザID',
    //     `task_id` bigint(16) unsigned NOT NULL COMMENT 'タスクID',
    //     `created_at` TIMESTAMP NULL DEFAULT NULL COMMENT '登録日時',
    //     `updated_at` TIMESTAMP NULL DEFAULT NULL COMMENT '更新日時',
    //     PRIMARY KEY (`id`),
    //     UNIQUE KEY (`user_id`,`task_id`),
    //     CONSTRAINT `PK_users_bookmarks`
    //     FOREIGN KEY (`user_id`)
    //     REFERENCES `users` (`id`),
    //     CONSTRAINT `PK_tasks_bookmarks`
    //     FOREIGN KEY (`task_id`)
    //     REFERENCES `tasks` (`id`)
    //     )

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_users');
    }
}
