<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->year('tahun_masuk');
            $table->year('tahun_lulus');
            $table->string('jurusan')->nullable();
            $table->text('deskripsi');
            $table->string('logo')->nullable(); // path logo, max 200x200px
            $table->string('color', 10)->nullable()->default('#A75F37'); // warna custom
            $table->boolean('aktif')->default(true);
            $table->string('pernah_menjadi_apa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolahs');
    }
};
