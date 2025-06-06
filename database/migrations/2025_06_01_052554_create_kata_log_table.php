<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kata_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kata_id')->constrained('kata')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('set null');
            $table->string('pelapor_id')->nullable();
            $table->string('pelapor_type')->nullable();
            $table->string('field_changed');
            $table->string('old_value')->nullable();
            $table->string('new_value')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kata_log');
    }
};