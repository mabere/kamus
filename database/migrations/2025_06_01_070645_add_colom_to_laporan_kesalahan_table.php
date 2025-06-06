<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('laporan_kesalahan', function (Blueprint $table) {
            $table->string('pelapor_id')->nullable()->after('status');
            $table->string('pelapor_type')->nullable()->after('pelapor_id');
        });
    }

    public function down()
    {
        Schema::table('laporan_kesalahan', function (Blueprint $table) {
            $table->dropColumn(['pelapor_id', 'pelapor_type']);
        });
    }
};