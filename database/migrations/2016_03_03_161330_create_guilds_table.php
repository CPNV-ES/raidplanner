<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuildsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('guilds', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('server_id')->unsigned();
      $table->integer('alliance_id')->nullable()->unsigned();
      $table->enum('alliance_role', ['master', 'officer', 'member'])->default('member');

      $table->string('name');
      $table->string('icon_path')->nullable();

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
    Schema::dropIfExists('guilds');
  }
}
