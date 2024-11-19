<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->integer('stock')->default(0);
            $table->decimal('costo', 8, 2)->default(0.00);
            $table->decimal('precio', 8, 2)->default(0.00);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
