<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('r_time')->nullable();
            $table->string('r_date')->nullable();
            $table->string('people')->nullable();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->text('details')->nullable();
            $table->string('status')->nullable();
            $table->string('r_month')->nullable();
            $table->string('r_year')->nullable();
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
        Schema::dropIfExists('_reservations');
    }
}
