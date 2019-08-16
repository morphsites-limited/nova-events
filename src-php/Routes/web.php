<?php

/**
 * Event routes
 */
Route::middleware('web')->prefix('events')->name('events.')->group(function () {
    Route::get('/', 'Dewsign\NovaEvents\Http\Controllers\EventController@index')->name('index');
});
