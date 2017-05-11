<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharitiesTable extends Migration
{
   public function up()
    {
        Schema::create('charities', function (Blueprint $charities) {
            $charities->increments('id'); 
            $charities->string('name');
            $charities->string('email', 100)->nullable();
            $charities->string('description')->nullable();
            $charities->integer('gross_receipts')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('charities');
    }
}
