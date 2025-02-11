<?php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

function mergeTranslationFiles()
{
    $strings = [];
    $locale = app()->getLocale();
    $jsonFilePath = resource_path('lang/' . $locale . '.json');
    if (file_exists($jsonFilePath)) {
        $strings = json_decode(file_get_contents($jsonFilePath), true);
    } else {
        $files = glob(resource_path('lang/' . $locale . '/*.php'));
        foreach ($files as $file) {
            $name = basename($file, '.php');
            $strings[$name] = require $file;
        }
    }

    return $strings;
}
