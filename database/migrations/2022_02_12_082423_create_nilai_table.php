<?php

use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->foreignIdFor(Siswa::class, 'nis')->constrained('siswa', 'nis')->cascadeOnUpdate();
            $table->foreignIdFor(MataPelajaran::class, 'kode_mapel')->constrained('mata_pelajaran', 'kode_mapel')->cascadeOnUpdate();
            $table->integer('kbm')->nullable();
            $table->integer('pengetahuan')->nullable();
            $table->integer('keterampilan')->nullable();
            $table->text('kd_pengetahuan')->nullable();
            $table->text('kd_keterampilan')->nullable();
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
        Schema::dropIfExists('nilai');
    }
}
