<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignCharacters extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('characters', function (Blueprint $table) {
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('server_id')->references('id')->on('servers')->onDelete('restrict');
      $table->foreign('archetype_id')->references('id')->on('archetypes')->onDelete('restrict');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('characters', function (Blueprint $table) {
      $table->dropForeign(['user_id']);
      $table->dropForeign(['server_id']);
      $table->dropForeign(['archetype_id']);
    });
  }
}
