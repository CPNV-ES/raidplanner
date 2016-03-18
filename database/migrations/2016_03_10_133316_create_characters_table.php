<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('characters', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('user_id')->unsigned();
      $table->integer('server_id')->unsigned();
      $table->integer('archetype_id')->unsigned();

      $table->string('name');
      $table->integer('level');
      $table->boolean('main');
      $table->string('description',2000);

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
    Schema::dropIfExists('characters');
  }
}
