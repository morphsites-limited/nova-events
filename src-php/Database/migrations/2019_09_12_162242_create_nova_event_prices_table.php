<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovaEventPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nova_event_prices', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('nova_events')->onDelete('cascade');
            
            $table->active();
            $table->string('title');
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
        Schema::dropIfExists('nova_event_prices');
    }
}
