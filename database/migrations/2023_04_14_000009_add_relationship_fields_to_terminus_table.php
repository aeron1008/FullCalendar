<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTerminusTable extends Migration
{
    public function up()
    {
        Schema::table('terminus', function (Blueprint $table) {
            $table->unsignedBigInteger('pacjent_id')->nullable();
            $table->foreign('pacjent_id', 'pacjent_fk_8318788')->references('id')->on('pacjentis');
            $table->unsignedBigInteger('zaposlenik_id')->nullable();
            $table->foreign('zaposlenik_id', 'zaposlenik_fk_8318789')->references('id')->on('zaposlenicis');
        });
    }
}
