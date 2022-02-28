<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsWitnessTable extends Migration
{

    public function up()
    {
        Schema::create('sessions_witness', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('prose_date');
            $table->bigInteger('session_no');
            $table->bigInteger('witness_name');
            $table->tinyInteger('witch_witness');
            $table->string('user_no');
            $table->text('command')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('sessions_witness');
    }
}
