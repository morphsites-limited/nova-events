<?php

namespace Dewsign\NovaEvents\Http\Controllers;

use Illuminate\Routing\Controller;
use Dewsign\NovaEvents\Models\Event;
use Illuminate\Support\Facades\View;

class EventController extends Controller
{
    /**
     * Show all events
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::active()->has('categories')->orderBy('start_date', 'desc')->get();

        return View::first([
            'events.index',
            'nova-events::index',
        ])->with('events', $events);
    }
}