<?php

namespace Dewsign\NovaEvents;

use Dewsign\NovaEvents\Models\Event;
use Illuminate\Support\Facades\File;

class NovaEvents
{
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