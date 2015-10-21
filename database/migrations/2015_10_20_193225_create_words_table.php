<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('words', function (Blueprint $table) {
      $table->increments('id');
      $table->string('word');
      $table->string('word_match')->nullable();
      $table->boolean('exact');
      $table->integer('response_id')->unsigned();
      $table->foreign('response_id')->references('id')->on('response');
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
    Schema::drop('words');
  }
}
