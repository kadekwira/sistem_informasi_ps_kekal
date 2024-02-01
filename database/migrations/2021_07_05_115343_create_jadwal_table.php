<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->char('type', 15)->nullable();
            $table->text('text')->nullable();
            $table->string('team1')->nullable();
            $table->string('team2')->nullable();
            $table->string('logo1')->nullable();
            $table->string('logo2')->nullable();
            $table->string('home_away')->nullable();
            $table->dateTime('jadwal')->nullable();
            $table->string('skor')->nullable();
            $table->string('lapangan')->nullable();
            $table->bigInteger('users_id')->nullable()->unsigned();
            $table->index('users_id')->nullable();
            $table->foreign('users_id')->nullable()->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('jadwal');
    }
}
