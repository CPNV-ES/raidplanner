<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignGuilds extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('guilds', function (Blueprint $table) {
      $table->foreign('server_id')->references('id')->on('servers')->onDelete('restrict');
      $table->foreign('alliance_id')->references('id')->on('alliances')->onDelete('set null');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('guilds', function (Blueprint $table) {
      $table->dropForeign(['server_id']);
      $table->dropForeign(['alliance_id']);
    });
  }
}
