<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignGroupMembers extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table ('group_members', function (Blueprint $table) {
      $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('group_members',function(Blueprint $table){
      $table->dropForeign(['group_id']);
      $table->dropForeign(['user_id']);
    });
  }
}
