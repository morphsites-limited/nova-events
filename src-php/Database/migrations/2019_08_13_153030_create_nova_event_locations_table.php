<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovaEventLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nova_event_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->active();
            
            $table->integer('event_id')->unsigned()->nullable();
            $table->foreign('event_id')->references('id')->on('nova_events')->onDelete('cascade');
            $table->integer('event_slot_id')->unsigned()->nullable();
            $table->foreign('event_slot_id')->references('id')->on('nova_event_slots')->onDelete('cascade');

            $table->text('title');
            $table->slug();
            $table->text('description');
            $table->string('info_page_link');
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
        Schema::dropIfExists('nova_event_locations');
    }
}
