<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id', 200)->nullable();
            $table->string('ref_no', 200)->nullable();
            $table->string('rider_id', 200)->nullable();
            $table->string('service', 200)->nullable();
            $table->string('sub', 200)->nullable();
            $table->string('status', 200)->nullable();
            $table->string('vehicle', 200)->nullable();
            $table->text('note')->nullable();
            $table->text('exact_address')->nullable();
            $table->string('receiver_name', 200)->nullable();
            $table->string('receiver_phone', 200)->nullable();
            $table->dateTime('schedule')->nullable();
            $table->text('pick_up')->nullable();
            $table->text('drop_off')->nullable();
            $table->float('amount')->nullable();
            $table->float('budget')->nullable();
            $table->float('weight')->nullable();
            $table->float('distance')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
