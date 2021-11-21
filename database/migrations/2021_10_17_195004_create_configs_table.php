<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('stream');
            $table->string('token_notify');
            $table->string('id_notify');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('whatsapp');
            $table->string('twitter');
            $table->string('site');
            $table->string('logotipo');
            $table->string('background');
            $table->string('webtv');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();             
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
        Schema::dropIfExists('configs');
    }
}
