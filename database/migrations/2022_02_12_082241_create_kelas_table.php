<?php

use App\Models\WaliKelas;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('tingkat')->unsigned();
            $table->enum('peminatan', ['mipa', 'ips']);
            $table->unsignedTinyInteger('ke');
            $table->foreignIdFor(WaliKelas::class, 'nip')->nullable()->constrained('wali_kelas', 'nip')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
}
