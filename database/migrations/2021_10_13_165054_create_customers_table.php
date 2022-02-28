<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name' , 35);
            $table->tinyInteger('gender');
            $table->double('personal_identity_type');
            $table->double('personal_identity_no');
            $table->string('phone_no' ,20);
            $table->bigInteger('state_name');
            $table->bigInteger('local_name');
            $table->bigInteger('administrative_unit_name');
            $table->text('command')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
