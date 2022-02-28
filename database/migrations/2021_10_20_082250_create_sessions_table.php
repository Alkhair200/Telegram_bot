<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{

    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('prose_date');
            $table->string('session_date');
            $table->string('session_time');
            $table->bigInteger('court_name');
            $table->bigInteger('lawyer_name');
            $table->bigInteger('lawyerTo_name');
            $table->bigInteger('judge_name');
            $table->text('session_decision');
            $table->tinyInteger('end_decision');
            $table->string('user_no');
            $table->text('command')->nullable();
            $table->string('month');
            $table->string('year');
            $table->string('day');
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
        Schema::dropIfExists('sessions');
    }
}
