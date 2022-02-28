<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultsTable extends Migration
{

    public function up()
    {
        Schema::create('consults', function (Blueprint $table) {
            $table->id();
            $table->string('consult_date');
            $table->bigInteger('consult_subject_no');
            $table->bigInteger('customer_name');
            $table->string('respondent_date');
            $table->string('respondent_time');
            $table->text('consult_text');
            $table->string('user_no');
            $table->text('command')->nullable();
            $table->string('month');
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
        Schema::dropIfExists('consults');
    }
}
