<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class NoFetchMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novels', function (Blueprint $table){
        	$table->increments('id');
        	$table->timestamps();
        	$table->string('name');
        	$table->string('author');
        	$table->string('website');
        	$table->string('state');
        	$table->string('lastDetect');
        	$table->string('url');
        	$table->string('latestChapter');
        });
        Schema::create('chapters', function (Blueprint $table){
        	$table->increments('id');
        	$table->timestamps();
        	$table->string('name');
        	$table->integer('index');
        	$table->string('state');
        	$table->string('error');
        	$table->text('content');
        	$table->string('url');
        	$table->integer('novel_id')->unsigned();
        	$table->foreign('novel_id')->references('id')->on('novels');
        });
        Schema::create('configs', function (Blueprint $table){
        	$table->increments('id');
        	$table->timestamps();
        	$table->string('key');
        	$table->string('value');
        });
        Schema::create('mails', function(Blueprint $table){
        	$table->increments('id');
        	$table->timestamps();
        	$table->string('state');
        	$table->string('error');
        	$table->string('name');
        	$table->text('content');
        	$table->integer('novel_id')->unsigned();
        	$table->foreign('novel_id')->references('id')->on('novels');
        	$table->integer('chapter_id')->unsigned();
        	$table->foreign('chapter_id')->references('id')->on('chapters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('novels');
        Schema::drop('chapters');
        Schema::drop('configs');
        Schema::drop('mails');
    }
}
