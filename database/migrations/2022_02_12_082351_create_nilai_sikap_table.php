<?php

use App\Models\PredikatSikap;
use App\Models\Siswa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiSikapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_sikap', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Siswa::class, 'nis');
            $table->foreignIdFor(PredikatSikap::class, 'predikat_spiritual')->nullable();
            $table->foreignIdFor(PredikatSikap::class, 'predikat_sosial')->nullable();
            $table->text('deskripsi_spiritual')->nullable();
            $table->text('deskripsi_sosial')->nullable();
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
        Schema::dropIfExists('nilai_sikap');
    }
}
