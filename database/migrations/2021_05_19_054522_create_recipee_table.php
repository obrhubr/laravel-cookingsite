<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Scout\Searchable;

class CreateRecipeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    use Searchable;

    public function up()
    {
        Schema::create('recipees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('imagepath');
            $table->string('ingredientsstr');
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
        Schema::dropIfExists('recipees');
    }
}
