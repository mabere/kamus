<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('laporan_kesalahan', function (Blueprint $table) {
            $table->text('catatan_ahli')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('laporan_kesalahan', function (Blueprint $table) {
            $table->dropColumn('catatan_ahli');
        });
    }
};