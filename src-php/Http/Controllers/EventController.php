<?php

namespace Dewsign\NovaEvents\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $events = app(config('nova-events.models.event', Event::class))::upcomingAndOnGoing()->withComputedDates()->active()->has('categories')->orderBy('start_date')->get();
        $categories = app(config('nova-events.models.category', EventCategory::class))::active()->has('events')->get();

        return View::first([
            'events.index',
            'nova-events::index',
        ])
        ->with('events', $events)
        ->with('categories', $categories);
    }

    /**
     * Show all archived events
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        $events = app(config('nova-events.models.event', Event::class))::withComputedDates()->active()->hasEnded()->has('categories')->orderBy('start_date', 'desc')->get();
        $categories = app(config('nova-events.models.category', EventCategory::class))::active()->has('events')->get();

        return View::first([
            'events.archive',
            'nova-events::index',
        ])
            ->with('events', $events)
            ->with('categories', $categories);
    }

    public function list(string $category)
    {
        $category = app(config('nova-events.models.category', EventCategory::class))::whereSlug($category)->firstOrFail();
        $categories = app(config('nova-events.models.category', EventCategory::class))::active()->has('events')->get();

        return View::first([
            'events.list',
            'nova-events::list',
        ])
        ->with('events', $category->activeEventsWithDates)
        ->with('category', $category)
        ->with('categories', $categories)
        ->with('page', $category)
        ->whenActive($category);
    }

    public function byDate(Request $request)
    {
        $date = Carbon::parse($request->query('date'));
        $events = app(config('nova-events.models.event', Event::class))::withComputedDates()->active()->isOngoing()->has('categories')->get();
        $categories = app(config('nova-events.models.category', EventCategory::class))::active()->has('events')->get();

        $events = $events->filter(function ($value) use ($date) {
            if ($value->start_date->lte($date) && $value->end_date->gte($date)) {
                return $value;
            }
        });

        return View::first([
            'events.by-date',
            'nova-events::by-date',
        ])
        ->with('events', $events)
        ->with('categories', $categories);
    }

    public function show(string $category, string $event)
    {
        $category = app(config('nova-events.models.category', EventCategory::class))::whereSlug($category)->firstOrFail();
        $event = app(config('nova-events.models.event', Event::class))::whereSlug($event)
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('id', '=', $category->id);
            })
            ->withComputedDates()
            ->firstOrFail();

        return View::first([
            $event->template ? "nova-events::templates.{$event->template}" : null,
            'nova-events::show',
        ])
        ->with('category', $category)
        ->with('event', $event)
        ->with('page', $event)
        ->whenActive($event);
    }
}
