<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // === KELAS ===
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas', 100);
            $table->timestamps();
        });

        // === GURU ===
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->timestamps();
            $table->softDeletes();
        });

        // === MURID ===
        Schema::create('murid', function (Blueprint $table) {
            $table->id();
            $table->string('nipd', 50)->unique();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->string('nama', 255);
            $table->string('sekolah', 255)->nullable();
            $table->unsignedInteger('absen')->nullable();
            $table->string('password', 255);
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign('kelas_id')
                ->references('id')
                ->on('kelas')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });

        // === BAB (Materi) ===
        Schema::create('bab', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('kelas_id');
            $table->string('judul_bab', 255);
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table
                ->foreign('guru_id')
                ->references('id')
                ->on('guru')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table
                ->foreign('kelas_id')
                ->references('id')
                ->on('kelas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // === ISI BAB (Sub Bab / Materi detail) ===
        Schema::create('isi_bab', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bab_id');
            $table->string('judul_sub_bab', 255)->nullable();
            $table->mediumText('isi_materi')->nullable();
            $table->timestamps();

            $table
                ->foreign('bab_id')
                ->references('id')
                ->on('bab')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // === LATIHAN ===
        Schema::create('latihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('bab_id');
            $table->string('judul', 255)->nullable();
            $table->text('deskripsi')->nullable();
            $table->unsignedInteger('waktu_pengerjaan')->nullable(); // dalam menit
            $table->unsignedInteger('jumlah_soal')->nullable();
            $table->timestamps();

            $table
                ->foreign('guru_id')
                ->references('id')
                ->on('guru')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table
                ->foreign('bab_id')
                ->references('id')
                ->on('bab')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // === ISI LATIHAN (Soal Latihan) ===
        Schema::create('isi_latihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('latihan_id');
            $table->text('soal')->nullable();
            $table->text('gambar')->nullable();
            $table->char('jawaban_benar', 1);
            $table->text('jawaban_a')->nullable();
            $table->text('jawaban_b')->nullable();
            $table->text('jawaban_c')->nullable();
            $table->text('jawaban_d')->nullable();
            $table->timestamps();

            $table
                ->foreign('latihan_id')
                ->references('id')
                ->on('latihan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // === ULANGAN ===
        Schema::create('ulangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('kelas_id');
            $table->string('judul', 255);
            $table->text('deskripsi')->nullable();
            $table->text('gambar')->nullable();
            $table->unsignedInteger('waktu_pengerjaan'); // dalam menit
            $table->unsignedInteger('jumlah_soal');
            $table->dateTime('waktu_dibuka');
            $table->dateTime('waktu_ditutup');
            $table->timestamps();

            $table
                ->foreign('guru_id')
                ->references('id')
                ->on('guru')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table
                ->foreign('kelas_id')
                ->references('id')
                ->on('kelas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // === ISI ULANGAN (Soal Ulangan) ===
        Schema::create('isi_ulangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ulangan_id');
            $table->text('soal')->nullable();
            $table->text('gambar')->nullable();
            $table->char('jawaban_benar', 1)->nullable();
            $table->text('jawaban_a')->nullable();
            $table->text('jawaban_b')->nullable();
            $table->text('jawaban_c')->nullable();
            $table->text('jawaban_d')->nullable();
            $table->timestamps();

            $table
                ->foreign('ulangan_id')
                ->references('id')
                ->on('ulangan')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        // === NILAI LATIHAN ===
        Schema::create('nilai_latihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('latihan_id');
            $table->unsignedBigInteger('murid_id');
            $table->unsignedInteger('nilai');
            $table->unsignedInteger('benar')->nullable();
            $table->unsignedInteger('salah')->nullable();
            $table->dateTime('dikerjakan_pada')->nullable();
            $table->timestamps();

            $table
                ->foreign('latihan_id')
                ->references('id')
                ->on('latihan')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreign('murid_id')
                ->references('id')
                ->on('murid')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // 1 murid 1 nilai per latihan (opsional)
            $table->unique(['latihan_id', 'murid_id']);
        });

        // === NILAI ULANGAN ===
        Schema::create('nilai_ulangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ulangan_id');
            $table->unsignedBigInteger('murid_id');
            $table->unsignedInteger('nilai');
            $table->unsignedInteger('benar')->nullable();
            $table->unsignedInteger('salah')->nullable();
            $table->dateTime('dikerjakan_pada')->nullable();
            $table->timestamps();

            $table
                ->foreign('ulangan_id')
                ->references('id')
                ->on('ulangan')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreign('murid_id')
                ->references('id')
                ->on('murid')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // 1 murid 1 nilai per ulangan (opsional)
            $table->unique(['ulangan_id', 'murid_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_ulangan');
        Schema::dropIfExists('nilai_latihan');
        Schema::dropIfExists('isi_ulangan');
        Schema::dropIfExists('ulangan');
        Schema::dropIfExists('isi_latihan');
        Schema::dropIfExists('latihan');
        Schema::dropIfExists('isi_bab');
        Schema::dropIfExists('bab');
        Schema::dropIfExists('murid');
        Schema::dropIfExists('guru');
        Schema::dropIfExists('kelas');
    }
};
