<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); 
            $table->integer('stock'); 
            $table->decimal('costo', 8, 2); 
            $table->decimal('precio', 8, 2); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventarios');
    }
}
