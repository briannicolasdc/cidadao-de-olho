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
        Schema::create('deputados', function (Blueprint $table) {

            $table->id();
            $table->string('nome');
            $table->string('partido');
            $table->string('endereco');
            $table->string('telefone');
            $table->string('fax');
            $table->string('email');
            $table->string('sitePessoal');
            $table->string('naturalidade');
            $table->string('uf');
            $table->string('nascimento');
            $table->jsonb('redesSociais');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deputados');
    }
};
