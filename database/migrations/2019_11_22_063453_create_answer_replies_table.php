<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('questionanswer_id')->nullable(false);
            $table->string('name');
            $table->text('reply');
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->timestamps();
        });
        Schema::table('answer_replies', function (Blueprint $table) {
            $table->foreign('questionanswer_id')->references('id')->on('question_answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_replies');
    }
}
