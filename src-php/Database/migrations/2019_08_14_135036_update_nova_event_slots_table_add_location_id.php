<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNovaEventSlotsTableAddLocationId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nova_event_slots', function (Blueprint $table) {
            $table->integer('event_location_id')->unsigned()->nullable();
            $table->foreign('event_location_id')->references('id')->on('nova_event_locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nova_event_slots', function (Blueprint $table) {
            $table->dropColumn('event_location_id');
        });
    }
}
