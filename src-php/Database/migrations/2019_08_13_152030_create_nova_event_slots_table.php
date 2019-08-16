<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovaEventSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nova_event_slots', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('nova_events')->onDelete('cascade');

            $table->active();
            $table->priority();
            $table->string('title');
            $table->text('long_desc');
            $table->text('short_desc');
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->dateTimeTz('start_date');
            $table->dateTimeTz('end_date');
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
        Schema::dropIfExists('nova_event_slots');
    }
}
