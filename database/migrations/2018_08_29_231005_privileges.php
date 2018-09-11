<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Privileges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Privileges', function (Blueprint $table) {
            $table->string('fid');                               // Foreign Key (Files table fid)
            $table->integer('privilege')->default(1);           // (DEFAULT 1, 0 => private || 1 => public)
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
        Schema::dropIfExists('Privileges');
    }
}
