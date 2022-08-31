<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            // $table->integer('tripnumber');
            $table->date('departuredate')->nullable();
            $table->time('departuretime')->nullable();
            $table->text('crewnotes')->nullable();
            $table->string('boatname', 20)->nullable();
            $table->string('destination', 40)->nullable();
            $table->time('duration')->nullable();
            $table->char('archived', 1)->nullable();
            $table->integer('crewneeded')->nullable();
            $table->double('cost')->nullable();
            $table->double('balance')->nullable();
            $table->char('sent_notice', 1);
            $table->integer('passengers');
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
        Schema::dropIfExists('trips');
    }
}
