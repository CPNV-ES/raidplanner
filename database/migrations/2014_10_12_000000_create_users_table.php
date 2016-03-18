<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('preferenced_server_id')->nullable()->unsigned();

      $table->string('username')->unique();
      $table->string('email')->unique();
      $table->string('password', 60);
      $table->string('firstname');
      $table->string('lastname');
      $table->date('birthday');

      $table->rememberToken();
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
    Schema::dropIfExists('users');
  }
}
