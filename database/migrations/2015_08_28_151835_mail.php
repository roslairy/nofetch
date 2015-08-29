<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class Mail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function(Blueprint $table){
        	$table->increments('id');
        	$table->timestamps();
        	$table->integer('chapterId');
        	$table->string('state');
        	$table->string('error');
        	$table->string('attachment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       	Schema::drop('mails');
    }
}
