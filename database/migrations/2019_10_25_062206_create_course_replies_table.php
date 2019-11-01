<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('coursecomment_id')->nullable(false);
            $table->string('name');
            $table->text('reply');
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->timestamps();
        });
        Schema::table('course_replies', function (Blueprint $table) {
            $table->foreign('coursecomment_id')->references('id')->on('course_comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_replies');
    }
}

