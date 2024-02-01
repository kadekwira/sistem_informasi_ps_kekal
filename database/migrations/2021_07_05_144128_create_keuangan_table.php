<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keuangan', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['masuk','keluar']);
            $table->double('nominal');
            $table->string('sumber');
            $table->string('bulan');
            $table->string('tahun');
            $table->date('tanggal');
            $table->double('total_uang');
            $table->string('bukti_pembayaran')->nullable();
            $table->string('penerima')->nullable();
            $table->string('subjek')->nullable();
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
        Schema::dropIfExists('keuangan');
    }
}
