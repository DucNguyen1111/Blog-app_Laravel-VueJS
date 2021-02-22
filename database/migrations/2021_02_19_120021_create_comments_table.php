<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->string('commentid')->primary();
            $table->string('userid');
            $table->foreign('userid')->references('userid')->on('users');
            $table->string('postid');
            $table->foreign('postid')->references('postid')->on('posts')->onDelete('cascade');
            $table->text('commentContent');
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
        Schema::dropIfExists('comments');
    }
}
