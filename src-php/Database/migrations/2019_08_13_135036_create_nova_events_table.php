<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovaEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nova_events', function (Blueprint $table) {
            $table->increments('id');
            $table->active();
            $table->priority();
            $table->string('template')->nullable();
            $table->string('title');
            $table->slug();
            $table->text('long_desc')->nullable();
            $table->text('short_desc')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->meta();
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
        Schema::dropIfExists('nova_events');
    }
}
