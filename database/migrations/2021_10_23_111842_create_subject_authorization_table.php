<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectAuthorizationTable extends Migration
{

    public function up()
    {
        Schema::create('subject_authorization', function (Blueprint $table) {
            $table->id();
            $table->text('subject_authorization_name');
            $table->text('command')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('subject_authorization');
    }
}
