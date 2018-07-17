<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoffesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::defaultStringLength(191);
        Schema::create('coffes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coffename');
            $table->string('lo');
            $table->string('la');
            $table->string('description');
            $table->decimal('nbusers', 8, 2);
            $table->decimal('numberofrate', 8, 2);
            $table->decimal('ratechicha', 8, 2);
            $table->integer('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('categorys')->onDelete('cascade');
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
        Schema::dropIfExists('coffes');
    }
}
