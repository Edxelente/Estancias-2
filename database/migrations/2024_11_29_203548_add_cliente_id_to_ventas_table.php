<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id'); 
            $table->unsignedBigInteger('cliente_id'); 
            $table->integer('cantidad'); 
            $table->decimal('monto', 10, 2); 
            $table->timestamps();
            
            // Claves foráneas
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
