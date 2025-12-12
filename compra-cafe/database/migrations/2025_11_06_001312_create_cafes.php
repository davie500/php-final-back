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
        Schema::create('cafes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('marca');
            $table->text('descricao');
            $table->decimal('preco', 10, 2);
            $table->integer('quantidade');
            $table->string('imagem_url');
            $table->timestamp('criado_em')->useCurrent();
        });

        // Schema::create('cafes_filtros', function (Blueprint $table) {
        //     $table->id();
        //     $table->dateTime('data_uso')->useCurrent();
        //     $table->boolean('usado')->default(false);
        //     $table->foreignId('marca_id')->constrained('cafes')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cafes');
        Schema::dropIfExists('cafes_filtros');
    }
};
