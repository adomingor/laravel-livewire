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
        Schema::create('categorias', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('categoria', 100);
            $table->boolean('activo')->default(true);
            $table->foreignId('id_users')->constrained('users');
            $table->timestamp('fecha_ins')->useCurrent();
            $table->timestamp('fecha_upd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
