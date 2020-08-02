<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 200)->unique();
            $table->string('role', 200)->nullable();
            $table->string('status', 200)->nullable();
            $table->string('name', 200);
            $table->date('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->string('contact', 200)->nullable();
            $table->string('license_no', 200)->nullable();
            $table->string('plate_no', 200)->nullable();
            $table->string('or', 200)->nullable();
            $table->string('cr', 200)->nullable();
            $table->string('country', 200)->nullable();
            $table->string('postal_code', 200)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 200);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
