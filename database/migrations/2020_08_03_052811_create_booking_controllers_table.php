<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingControllersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_controllers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id', 200)->nullable();
            $table->string('rider_id', 200)->nullable();
            $table->string('status', 200)->nullable();
            $table->string('vehicle', 200)->nullable();
            $table->text('description')->nullable();
            $table->dateTime('pick-up')->nullable();
            $table->dateTime('drop-off')->nullable();
            $table->dateTime('amount')->nullable();
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
        Schema::dropIfExists('booking_controllers');
    }
}
