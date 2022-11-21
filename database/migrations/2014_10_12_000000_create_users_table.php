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
            $table->string('name');
            $table->string('alamat');
            $table->string('notelp');
            $table->string('nik');
            $table->foreignId('divisi_id');
            $table->foreignId('golongan_id')->nullable();
            $table->string('email');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('path_gambar')->nullable();
            $table->string('role');
            $table->rememberToken();
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
