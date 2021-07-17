<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('year');
            $table->date('release_date');
            $table->string('duration');
            $table->string('region');
            $table->string('language');
            $table->string('category');
            $table->string('genres');
            $table->string('directors');
            $table->string('writers');
            $table->string('cast');
            $table->string('poster')->nullable();
            $table->string('poster_link')->nullable();
            $table->string('cover')->nullable();
            $table->string('cover_link')->nullable();
            $table->text('plot');
            $table->text('summary');
            $table->string('movie_link');
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
        Schema::dropIfExists('movies');
    }
}
