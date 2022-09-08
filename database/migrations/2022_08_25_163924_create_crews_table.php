<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crews', function (Blueprint $table) {
            $table->id();

            $table->string("initials");
            $table->string("fullname",40)->nullable();
            $table->string("emailaddress",40)->nullable();
            $table->char("firstaid", 1)->nullable();
            $table->char("rya", 1)->nullable();
            $table->char("cba", 1)->nullable();
            $table->char("iwa", 1)->nullable();
            $table->string("keyholder",10)->nullable();
            $table->char("skipper", 1)->nullable();
            $table->string("mobile")->nullable();
            $table->string("secondarynumber")->nullable();
            $table->char('archived',1)->nullable();
            $table->string("pswd",32)->nullable();
            $table->integer("privilege")->nullable();
            $table->string("username",20)->nullable();
            $table->char("optin", 1)->nullable();
            $table->date("faexpire")->nullable();
            $table->string("boatpreference",10)->nullable();
            $table->integer("traveltime")->nullable();
            $table->string("memnumber",10)->nullable();
            $table->datetime("lastlogin")->nullable();
            $table->tinyInteger("suspended");
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('crews');
    }
}




