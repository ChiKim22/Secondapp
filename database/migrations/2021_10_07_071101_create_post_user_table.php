<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_user', function (Blueprint $table) {
            $table->id();
            //users table과 posts 테이블의 primary key 를 참조하는 외래키 칼럼
            $table->foreignId('user_id')->constrained()
                        ->onDelete('cascade'); // 부모를 지우면 자식까지 같이 삭제.
            $table->foreignId('post_id')->constrained()
                        ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_user');
    }
}
