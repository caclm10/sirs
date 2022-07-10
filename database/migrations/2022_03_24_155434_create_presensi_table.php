<?php

use App\Models\Siswa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->id("id_presensi");
            $table->foreignIdFor(Siswa::class, "nis")->constrained('siswa', 'nis')->cascadeOnUpdate();
            $table->date("tanggal_hadir");
            $table->time("waktu_hadir")->nullable();
            $table->enum("keterangan", ["sakit", "izin", "tanpa keterangan"])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presensi');
    }
}
