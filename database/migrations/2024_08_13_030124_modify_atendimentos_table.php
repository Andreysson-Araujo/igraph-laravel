<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('atendimentos', function (Blueprint $table) {
        $table->string('new_column')->nullable();
        // Outras modificações que deseja fazer
    });
}

public function down(): void
{
    Schema::table('atendimentos', function (Blueprint $table) {
        $table->dropColumn('new_column');
        // Reverter as outras modificações
    });
}

};
