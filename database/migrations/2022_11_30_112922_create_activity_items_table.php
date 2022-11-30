<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_items', function (Blueprint $table) {
            $table->id();
            $table->string('activityname', 255)->nullable();
            $table->string('activitytype', 40)->nullable();
            $table->integer('activitycapacity')->nullable();
            $table->longText('activitypicture')->nullable();
            $table->integer('minimumcrew')->nullable();
            $table->string('rgbcolor', 255)->nullable();
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
        Schema::dropIfExists('activity_items');
    }
}
