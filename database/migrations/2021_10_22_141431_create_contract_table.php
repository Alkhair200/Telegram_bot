<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractTable extends Migration
{

    public function up()
    {
        Schema::create('contract', function (Blueprint $table) {
            $table->id();
            $table->string('contract_date');
            $table->bigInteger('contract_subject');
            $table->bigInteger('first_side_no');
            $table->bigInteger('second_side_no');
            $table->bigInteger('first_witness_no');
            $table->bigInteger('second_witness_no');
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
        Schema::dropIfExists('contract');
    }
}
