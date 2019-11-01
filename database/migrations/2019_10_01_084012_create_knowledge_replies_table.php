<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnowledgeRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('knowledgecomment_id')->nullable(false);
            $table->string('name');
            $table->text('reply');
            $table->unsignedBigInteger('user_id')->nullable(false);
            $table->timestamps();
        });
        Schema::table('knowledge_replies', function (Blueprint $table) {
            $table->foreign('knowledgecomment_id')->references('id')->on('knowledge_comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('knowledge_replies');
    }
}


