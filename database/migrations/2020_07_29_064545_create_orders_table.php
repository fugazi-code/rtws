<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->date('date_ordered')->nullable();
            $table->integer('rider_id')->nullable();
            $table->date('date_confirmed')->nullable();
            $table->text('delivery_from')->nullable();
            $table->text('delivery_to')->nullable();
            $table->string('recipient', 200)->nullable();
            $table->string('status', 200)->nullable();
            $table->float('delivery_fee')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
