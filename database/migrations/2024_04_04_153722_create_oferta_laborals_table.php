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
        Schema::create('oferta_laborals', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('ubicacion');
            $table->string('remuneracion');
            $table->string('descripcion');
            $table->text('body');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->enum('state', [1, 2]); //1:escondido  2:visible
            $table->string('limite_postulante')->nullable();
            $table->string('documentos_oferta')->nullable();
            // $table->unsignedBigInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oferta_laborals');
    }
};
