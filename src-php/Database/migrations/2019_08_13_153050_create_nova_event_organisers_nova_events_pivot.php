<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovaEventOrganisersNovaEventsPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nova_event_organisers_nova_events', function (Blueprint $table) {
            $table->integer('organiser_id')->unsigned()->nullable();
            $table->foreign('organiser_id')->references('id')->on('nova_event_organisers')->onDelete('cascade');
            $table->integer('nova_event_id')->unsigned()->nullable();
            $table->foreign('nova_event_id')->references('id')->on('nova_events')->onDelete('cascade');
            $table->primary(['organiser_id', 'nova_event_id'], 'event_organiser_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nova_event_organisers_nova_events');
    }
}
