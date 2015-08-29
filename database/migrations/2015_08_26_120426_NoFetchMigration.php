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
        	$table->string('lastDetect');
        	$table->string('url');
        	$table->string('latestChapter');
        });
        Schema::create('chapters', function (Blueprint $table){
        	$table->increments('id');
        	$table->timestamps();
        	$table->string('name');
        	$table->string('novel');
        	$table->integer('index');
        	$table->string('state');
        	$table->string('error');
        	$table->text('content');
        	$table->string('url');
        });
        Schema::create('configs', function (Blueprint $table){
        	$table->increments('id');
        	$table->timestamps();
        	$table->string('key');
        	$table->string('value');
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
    }
}
