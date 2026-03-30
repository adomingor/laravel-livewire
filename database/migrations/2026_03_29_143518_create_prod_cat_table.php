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
        Schema::create('prod_cat', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_productos');
            $table->unsignedSmallInteger('id_categorias');
            $table->boolean('activo')->default(true);
            $table->foreignId('id_users')->constrained('users');
            $table->timestamp('fecha_ins')->useCurrent();
            $table->timestamp('fecha_upd')->nullable();

            $table->foreign('id_productos')->references('id')->on('productos')->restrictOnUpdate()->restrictOnDelete();
            $table->foreign('id_categorias')->references('id')->on('categorias')->restrictOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prod_cat');
    }
};
