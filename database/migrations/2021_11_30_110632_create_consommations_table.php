<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsommationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consommations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appareil_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('matiere_id')->constrained()->onDelete('cascade'); 
            $table->integer('consommation'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consommations');
    }
}
