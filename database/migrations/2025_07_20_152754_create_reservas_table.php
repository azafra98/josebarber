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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idCliente')->constrained('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('idCorte')->constrained('cortes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('idHorario')->constrained('horarios')->onDelete('restrict')->onUpdate('cascade');
            $table->date('dia');
            $table->unique(['idHorario', 'dia'], 'cita');
            $table->timestamps();

            /*
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('idCliente');
            $table->unsignedBigInteger('idCorte');
            $table->unsignedBigInteger('idHorario');
            $table->foreign('idCliente')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('idCorte')
                ->references('id')->on('cortes')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('idHorario')
                ->references('id')->on('horarios')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->date('dia');
            $table->unique(["idHorario", "dia"], 'cita');
            $table->timestamps();
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
