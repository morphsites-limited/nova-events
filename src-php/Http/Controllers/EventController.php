<?php

namespace Dewsign\NovaEvents\Http\Controllers;

use Illuminate\Routing\Controller;
use Dewsign\NovaEvents\Models\Event;
use Illuminate\Support\Facades\View;
use Dewsign\NovaEvents\Models\EventCategory;

class EventController extends Controller
{
    /**
     * Show all events
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = app(config('nova-events.models.event', Event::class))::active()->has('categories')->orderBy('start_date', 'desc')->get();

        return View::first([
            'events.index',
            'nova-events::index',
        ])->with('events', $events);
    }

    public function list(string $category)
    {
        $category = app(config('nova-events.models.category', EventCategory::class))::whereSlug($category)->firstOrFail();

        return view::first([
            'events.list',
            'nova-events::list',
        ])->with('category', $category);
    }

    public function show(string $category, string $event)
    {

    }
}