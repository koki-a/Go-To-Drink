<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AppCreateTables extends Migration
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
            $table->string('name')->unique();
            $table->string('avatar_file_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('follows', function (Blueprint $table){

            $table->id();
            $table->unsignedBigInteger('follower_id');
            $table->unsignedBigInteger('followee_id');
            $table->timestamps();

            //外部キー制約
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('followee_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('genres', function (Blueprint $table){

            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        
        Schema::create('situations', function (Blueprint $table){

            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        
        Schema::create('shops', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('genre_id');
            $table->string('shop_file_name')->nullable();
            $table->string('name');
            $table->string('address');
            $table->string('url')->nullable();
            $table->string('tell');
            $table->text('comment')->nullable();
            $table->timestamps();
            

            //外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('genre_id')->references('id')->on('genres');
            
        });

        //shopsとsituationsの中間テーブル
        Schema::create('shop_situation', function (Blueprint $table){

            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('situation_id');
            $table->timestamps();

            //外部キー制約
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->foreign('situation_id')->references('id')->on('situations')->onDelete('cascade');
        });

        //shopsとusersの中間テーブル いいね機能
        Schema::create('likes', function (Blueprint $table){

            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shop_id');
            $table->timestamps();

            //外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('shop_user');
        Schema::dropIfExists('shop_situation');
        Schema::dropIfExists('likes');
        Schema::dropIfExists('situations');
        Schema::dropIfExists('shops');
        Schema::dropIfExists('users');
    }
}
