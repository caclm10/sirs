<?php

use App\Models\Ekstrakurikuler;
use App\Models\Siswa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEkskulSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekskul_siswa', function (Blueprint $table) {
            $table->foreignIdFor(Siswa::class, 'nis')->constrained('siswa', 'nis')->cascadeOnUpdate();
            $table->foreignIdFor(Ekstrakurikuler::class, 'kode_ekskul')->constrained('ekstrakurikuler', 'kode_ekskul')->cascadeOnUpdate();
            $table->integer('nilai')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('semester', ['ganjil', 'genap']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ekskul_siswa');
    }
}
