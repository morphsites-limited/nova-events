<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNovaEventLocationsTableDescriptionNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nova_event_locations', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
            $table->string('info_page_link')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nova_event_locations', function (Blueprint $table) {
            $table->text('description')->nullable(false)->change();
            $table->string('info_page_link')->nullable(false)->change();
        });
    }
}