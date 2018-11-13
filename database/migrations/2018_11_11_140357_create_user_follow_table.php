<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFollowTable extends Migration
{
     public function up()
    {
        Schema::create('user_follow', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('follow_id')->unsigned()->index(); //user_idと同じ
            $table->timestamps();
            
            //外部キー設定
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('follow_id')->references('id')->on('users')->onDelete('cascade');
        //   onDelete('cascade')=>userのアカウントが消えると、followしていた人、されていた人のデータも同時に消える
           
        //   user_idとfollow_idの重複を禁止(同じuserを何度もfollowできないようにする)
            $table->unique(['user_id','follow_id']);
            });
    }


    public function down()
    {
        Schema::dropIfExists('user_follow');
    }
}
