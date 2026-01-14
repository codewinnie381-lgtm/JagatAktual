<?php

if (! function_exists('category_color')) {
    function category_color(string $slug): string
    {
        return match ($slug) {
            'olahraga' => '#2563eb',
            'politik' => '#0f766e',
            'hiburan' => '#9333ea',
            'teknologi' => '#16a34a',
            default => '#2563eb',
        };
    }
}
