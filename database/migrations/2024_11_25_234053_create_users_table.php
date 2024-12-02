<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique(); // Asegúrate de que el nombre de usuario sea único
            $table->string('password'); // Contraseña
            $table->timestamps(); // Campos 'created_at' y 'updated_at'
        });
    }
        
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::table('users', function (Blueprint $table) {
            $table->dropTimestamps(); // Eliminar los campos 'created_at' y 'updated_at'
        });
    }
    
};
