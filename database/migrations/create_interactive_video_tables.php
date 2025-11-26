<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Create interactive videos table with description
        Schema::create('interactive_videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable(); // Added directly here
            $table->string('video_path');
            $table->string('thumbnail_path')->nullable();
            $table->timestamps();
        });

        // Create questions table
        Schema::create('interactive_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interactive_video_id')->constrained()->onDelete('cascade');
            $table->integer('time_marker');
            $table->text('question');
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c');
            $table->string('option_d');
            $table->string('correct_answer');
            $table->timestamps();
        });

        // Add required columns to isi_bab in single operation
        Schema::table('isi_bab', function (Blueprint $table) {
            if (!Schema::hasColumn('isi_bab', 'judul')) {
                $table->string('judul')->nullable();
            }
            if (!Schema::hasColumn('isi_bab', 'sub_bab')) {
                $table->string('sub_bab')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::dropIfExists('interactive_questions');
        Schema::dropIfExists('interactive_videos');
        
        Schema::table('isi_bab', function (Blueprint $table) {
            $table->dropColumn(['judul', 'sub_bab']);
        });
    }
};