<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('subscribes', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('event_id')->unsigned();
      $table->integer('subscriber_id')->unsigned();

      $table->string('comment',2000);

      $table->timestamps();
    });

    Schema::create('characters_subscribes', function (Blueprint $table) {
      $table->integer('subscribe_id')->unsigned();
      $table->integer('character_id')->unsigned();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('subscribes');
    Schema::dropIfExists('characters_subscribes');
  }
}
