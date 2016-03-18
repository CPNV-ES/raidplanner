<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuildMembersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('guild_members', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('guild_id')->unsigned();
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
    Schema::dropIfExists('guild_members');
  }
}
