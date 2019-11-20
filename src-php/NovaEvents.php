<?php

namespace Dewsign\NovaEvents;

use Dewsign\NovaEvents\Models\Event;
use Illuminate\Support\Facades\File;
use Dewsign\NovaEvents\Models\EventCategory;

class NovaEvents
{
    public static function sitemap($sitemap)
    {
        static::addIndex($sitemap);
        static::addCategories($sitemap);
        static::addEvents($sitemap);
    }

    public static function addIndex($sitemap)
    {
        $sitemap->add(route('events.index'));
    }

    public static function addCategories($sitemap)
    {
        app(config('nova-events.models.category', EventCategory::class))::active()
            ->has('events')
            ->get()
            ->each(function ($category) use ($sitemap) {
                $sitemap->add(route('events.list', $category));
            });

    }

    public static function addEvents($sitemap)
    {
        app(config('nova-events.models.events', Event::class))::active()
            ->has('categories')
            ->get()
            ->each(function ($event) use ($sitemap) {
                $sitemap->add(route('events.show', [$event->primaryCategory, $event]));
            });
    }

    public static function availableTemplates()
    {
        $packageTemplatePath = __DIR__ . '/Resources/views/templates';
        $appTemplatePath = resource_path() . '/views/vendor/nova-events/templates';

        $packageTemplates = File::exists($packageTemplatePath) ? File::files($packageTemplatePath) : null;
        $appTemplates = File::exists($appTemplatePath) ? File::files($appTemplatePath) : null;

        return collect($packageTemplates)->merge($appTemplates)->mapWithKeys(function ($file) {
            $filename = $file->getFilename();

            return [
                str_replace('.blade.php', '', $filename) => static::getPrettyFilename($filename),
            ];
        });

    }

    private static function getPrettyFilename($filename)
    {
        $basename = str_replace('.blade.php', '', $filename);

        return title_case(str_replace('-', ' ', $basename));
    }
}