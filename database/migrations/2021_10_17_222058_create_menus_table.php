<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->boolean('webtv');
            $table->boolean('radio');
            $table->boolean('facebook');
            $table->boolean('instagram');
            $table->boolean('twitter');
            $table->boolean('promotion');
            $table->boolean('notice');
            $table->boolean('message');
            $table->boolean('push');
            $table->boolean('team');
            $table->boolean('programation');       
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
        Schema::dropIfExists('menus');
    }
}
