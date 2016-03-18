<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMembersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('group_members', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('group_id')->unsigned();
      $table->integer('user_id')->unsigned();

      $table->enum('role', ['master', 'officier', 'member'])->default('member');

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
    Schema::dropIfExists('group_members');
  }
}
