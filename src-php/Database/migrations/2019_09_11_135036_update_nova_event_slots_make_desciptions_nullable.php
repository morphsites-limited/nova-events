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
            $table->text('long_desc')->nullable()->change();
            $table->text('short_desc')->nullable()->change();
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
            $table->text('long_desc')->nullable(false)->change();
            $table->text('short_desc')->nullable(false)->change();
        });
    }
}
