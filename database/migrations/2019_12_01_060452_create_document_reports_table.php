<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('document_id')->nullable(false);
            $table->unsignedBigInteger('report_by')->nullable(false);
            $table->string('reportType');
            $table->boolean('reportStatus')->default(0);
            $table->text('reportDescription');
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
        Schema::dropIfExists('document_reports');
    }
}
