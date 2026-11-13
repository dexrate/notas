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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('usuario', 80)->nullable();
            $table->string('senha', 255)->nullable();
            $table->dateTime('ultimo_login')->nullable();
            $table->timestamps();// Cria as colunas created_at e updated_at
            //softDeletes
            $table->softDeletes(); // Cria a coluna deleted_at para soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
