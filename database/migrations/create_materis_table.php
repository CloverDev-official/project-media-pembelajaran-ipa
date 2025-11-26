<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materi_id')->constrained('isi_bab')->onDelete('cascade');
            $table->foreignId('interactive_video_id')->constrained('interactive_videos')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['materi_id', 'interactive_video_id']); // Prevent duplicate relationships
        });
    }

    public function down()
    {
        Schema::dropIfExists('materis');
    }
};