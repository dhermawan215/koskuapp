<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKontrakan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrakan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id');
            $table->string('name');
            $table->text('address');
            $table->string('district');
            $table->string('regency');
            $table->longText('facility');
            $table->integer('price');
            $table->double('ratings');
            $table->string('tags');
            $table->string('whatsapp_number');
            $table->string('gmap_url');
            $table->string('latitude');
            $table->string('longtitude');
            $table->string('picture', 2048)->nullable();
            $table->softDeletes();


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
        Schema::dropIfExists('kontrakan');
    }
}
