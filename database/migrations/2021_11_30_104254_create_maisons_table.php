<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maisons', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); 
            $table->integer('num_rue'); 
            $table->string('nom_rue'); 
            $table->foreignId('ville_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('statusecologique_id')->constrained(); 
            $table->foreignId('isolation_id')->constrained(); 
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
        Schema::dropIfExists('maisons');
    }
}
