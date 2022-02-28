<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsecutionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prosecution', function (Blueprint $table) {
            $table->id();
            $table->string('prose_date');
            $table->bigInteger('customer_name');
            $table->bigInteger('customerTo_name');
            $table->bigInteger('prose_text_name');
            $table->tinyInteger('prose_type');
            $table->bigInteger('cause_lawsuit_name');
            $table->string('user_no');
            $table->text('command')->nullable();
            $table->string('month');
            $table->string('year');
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
        Schema::dropIfExists('prosecution');
    }
}
