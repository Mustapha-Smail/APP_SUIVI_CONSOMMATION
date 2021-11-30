<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appareil_id')->constrained(); 
            $table->foreignId('matiere_id')->constrained(); 
            $table->dateTime('emission'); 
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
        Schema::dropIfExists('emissions');
    }
}
