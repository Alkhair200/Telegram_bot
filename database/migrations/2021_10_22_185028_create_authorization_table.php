<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorizationTable extends Migration
{

    public function up()
    {
        Schema::create('authorization', function (Blueprint $table) {
            $table->id();
            $table->string('authorization_date');
            $table->tinyInteger('authorization_type');
            $table->bigInteger('client_name');
            $table->bigInteger('clientTo_name');
            
            $table->bigInteger('authorization_no');
            $table->bigInteger('authorization_subject_no');
            $table->bigInteger('first_witness_no');
            $table->bigInteger('second_witness_no');
            $table->string('user_no');
            $table->text('command')->nullable();
            $table->string('month');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('authorization');
    }
}
