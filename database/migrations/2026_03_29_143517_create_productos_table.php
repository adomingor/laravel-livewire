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
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('producto', 100);
            $table->text('descripcion')->nullable();
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
        Schema::dropIfExists('productos');
    }
};
