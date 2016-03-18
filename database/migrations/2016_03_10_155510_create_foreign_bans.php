<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignBans extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('bans', function (Blueprint $table) {
      $table->foreign('target_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('bans', function (Blueprint $table) {
      $table->dropForeign(['target_id']);
      $table->dropForeign(['author_id']);
    });
  }
}
