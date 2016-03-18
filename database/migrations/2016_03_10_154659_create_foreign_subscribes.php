<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignSubscribes extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('subscribes', function (Blueprint $table) {
      $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
      $table->foreign('subscriber_id')->references('id')->on('users')->onDelete('cascade');
    });

    Schema::table('characters_subscribes', function (Blueprint $table) {
      $table->foreign('subscribe_id')->references('id')->on('subscribes')->onDelete('cascade');
      $table->foreign('character_id')->references('id')->on('characters')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('subscribes', function (Blueprint $table) {
      $table->dropForeign(['event_id']);
      $table->dropForeign(['subscriber_id']);
    });

    Schema::table('characters_subscribes', function (Blueprint $table) {
      $table->dropForeign(['subscribe_id']);
      $table->dropForeign(['character_id']);
    });
  }
}
