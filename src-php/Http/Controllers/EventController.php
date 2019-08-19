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
        $categories = app(config('nova-events.models.category', EventCategory::class))::active()->has('events')->get();

        return View::first([
            'events.index',
            'nova-events::index',
        ])
        ->with('events', $events)
        ->with('categories', $categories);
    }

    public function list(string $category)
    {
        $category = app(config('nova-events.models.category', EventCategory::class))::whereSlug($category)->firstOrFail();

        return View::first([
            'events.list',
            'nova-events::list',
        ])
        ->with('category', $category)
        ->with('page', $category);
    }

    public function show(string $category, string $event)
    {
        $category = app(config('nova-events.models.category', EventCategory::class))::whereSlug($category)->firstOrFail();
        $event = app(config('nova-events.models.event', Event::class))::whereSlug($event)
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('id', '=', $category->id);
            })
            ->firstOrFail();

        return View::first([
            'events.show',
            'nova-events::show',
        ])
        ->with('category', $category)
        ->with('event', $event)
        ->with('page', $event);
    }
}