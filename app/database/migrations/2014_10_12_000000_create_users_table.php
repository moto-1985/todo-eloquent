<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            // $table->id();
            // $table->string('last_name', 15);
            // $table->string('first_name', 15);
            // $table->string('email', 63)->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->boolean('lock')->default(0);
            // $table->timestamp('expires_at')->nullable();
            // $table->string('password', 63)->unique();
            // $table->softDeletes('deleted_at');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
