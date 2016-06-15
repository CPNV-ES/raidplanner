<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStartEndFieldEvents extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('events', function (Blueprint $table) {
      $table->dateTime('start');
      $table->dateTime('end');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('events',function(Blueprint $table){
      $table->dropColumn('start');
      $table->dropColumn('end');
    });
  }
}
