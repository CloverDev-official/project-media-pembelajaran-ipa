<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('drag_drop_games', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('game_config'); // Konfigurasi game
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->constrained('users'); // Guru yang membuat
            $table->timestamps();
        });

        Schema::create('drag_drop_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('drag_drop_games')->onDelete('cascade');
            $table->string('item_text'); // Teks yang bisa di-drag
            $table->string('item_image')->nullable(); // Gambar (jika ada)
            $table->integer('correct_position'); // Posisi yang benar
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('drag_drop_items');
        Schema::dropIfExists('drag_drop_games');
    }
};