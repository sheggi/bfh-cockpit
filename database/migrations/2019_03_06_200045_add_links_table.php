<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table){
            $table->increments('id');

            $table->integer('lesson_id');

            $table->string('title');
            $table->string('url');

            $table->timestamps();
        });

        Schema::table('lessons', function (Blueprint $table){
           $table->dropColumn('links');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
}
