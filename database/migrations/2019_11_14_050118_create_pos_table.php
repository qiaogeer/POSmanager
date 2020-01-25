<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('delivery_time')->nullable();
            $table->string('receive_name',50)->nullable();
            $table->string('serial_number',40);
            $table->string('agent_name',50)->nullable();
            $table->timestamp('config_time')->nullable();
            $table->string('company_name',50)->nullable();
            $table->string('william_id',40)->nullable();
            $table->string('kem_id',40)->nullable();
            $table->string('terminal_number',40)->nullable();
            $table->integer('device_type');
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
        Schema::dropIfExists('pos');
    }
}
