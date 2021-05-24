<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('categoria_id')->constrained('categories');
            $table->string('main_image');
            $table->string('address');
            $table->string('lat');
            $table->string('lng');
            $table->string('phone');
            $table->text('description');
            $table->time('opened');
            $table->time('closed');
            $table ->uuid('uuid');
            $table->foreignId('user_id')->constrained('users');

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
        Schema::dropIfExists('shops');
        Schema::dropIfExists('categories');
    }
}
