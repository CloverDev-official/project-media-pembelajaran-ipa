<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gim_levels', function (Blueprint $table) {
            $table->id();
            $table->string('judul_level');
            $table->text('deskripsi')->nullable();
            $table->json('pasangan'); // Menyimpan pasangan item dalam format JSON
            $table->integer('urutan')->default(0); // Untuk mengurutkan level
            $table->boolean('aktif')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gim_levels');
    }
};