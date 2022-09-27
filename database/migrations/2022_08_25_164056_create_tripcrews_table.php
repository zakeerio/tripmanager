<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripcrewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tripcrews', function (Blueprint $table) {
            $table->id();

            $table->integer('recordnumber');
            $table->string('crewcode',5)->nullable();
            $table->char('available', 1)->nullable();
            $table->char('confirmed', 1)->nullable();
            $table->char('isskipper', 1)->nullable();
            $table->unsignedBigInteger('tripnumber')->nullable();
            $table->foreign('tripnumber')->references('id')->on('trips')->onDelete('cascade');
            $table->string('notes')->nullable();

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
        Schema::dropIfExists('tripcrews');
    }
}


