<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharitiesTable extends Migration
{
   public function up()
    {
        Schema::create('charities', function (Blueprint $charities) {
            $charities->increments('id'); 
            $charities->string('name', 100);
            $charities->string('location', 100);
            $charities->string('category', 100);
            $charities->string('description')->nullable();
            $charities->integer('gross_receipts');
        });
    }

    public function down()
    {
        Schema::dropIfExists('charities');
    }
}
