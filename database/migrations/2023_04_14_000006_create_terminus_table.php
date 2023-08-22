<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminusTable extends Migration
{
    public function up()
    {
        Schema::create('terminus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('start_time');
            $table->datetime('finish_time');
            $table->longText('komentar')->nullable();
            $table->integer('allow_notifications')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
