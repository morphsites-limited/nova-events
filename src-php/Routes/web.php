<?php

/**
 * Event routes
 */
Route::middleware('web')->prefix('events')->name('events.')->group(function () {
    Route::get('/', 'Dewsign\NovaEvents\Http\Controllers\EventController@index')->name('index');
    Route::get('/archive', 'Dewsign\NovaEvents\Http\Controllers\EventController@archive')->name('archive');
    Route::get('/by-date', 'Dewsign\NovaEvents\Http\Controllers\EventController@byDate')->name('by-date');
    Route::get('{category}', 'Dewsign\NovaEvents\Http\Controllers\EventController@list')->name('list');
    Route::get('{category}/{event}', 'Dewsign\NovaEvents\Http\Controllers\EventController@show')->name('show');
});
