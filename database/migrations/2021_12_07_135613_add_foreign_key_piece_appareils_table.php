<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyPieceAppareilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appareils', function (Blueprint $table) {
            $table->foreignId('piece_id')->constrained()->onDelete('CASCADE'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appareils', function (Blueprint $table) {
            $table->dropForeign(['piece_id']);
            $table->dropColumn('piece_id');
        });
    }
}
