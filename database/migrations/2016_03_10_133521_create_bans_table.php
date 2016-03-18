<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBansTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('bans', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('target_id')->unsigned();
      $table->integer('author_id')->nullable()->unsigned();

      $table->morphs('from');
      $table->string('reason', 2000);

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
    Schema::dropIfExists('bans');
  }
}
