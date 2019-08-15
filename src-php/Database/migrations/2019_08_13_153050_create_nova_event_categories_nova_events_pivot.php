<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovaEventCategoriesNovaEventsPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nova_event_categories_nova_events', function (Blueprint $table) {
            $table->integer('nova_event_id')->unsigned()->nullable();
            $table->foreign('nova_event_id')->references('id')->on('nova_events')->onDelete('cascade');
            $table->integer('nova_event_category_id')->unsigned()->nullable();
            $table->foreign('nova_event_category_id')->references('id')->on('nova_event_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nova_event_categories_nova_events');
    }
}
