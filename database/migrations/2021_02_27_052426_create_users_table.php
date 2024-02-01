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
            $table->string('nama');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('level');
            $table->date('tanggal_lahir');
            $table->integer('usia');
            $table->string('avatar')->nullable();
            $table->boolean('status');
            $table->string('nohp');
            $table->text('alamat');
            $table->rememberToken();
            $table->timestamps();
            // $table->bigInteger('karyawan_id')->nullable()->unsigned();
            // $table->index('karyawan_id')->nullable();
            // $table->foreign('karyawan_id')->nullable()->references('id')->on('karyawan')->onDelete('cascade');
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
