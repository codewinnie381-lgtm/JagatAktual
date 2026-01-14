<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class AuthorDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?string $navigationLabel = 'Dashboard Author';
    protected static ?string $title = 'Dashboard Author';

    protected static string $view = 'filament.pages.author-dashboard';

    /**
     * Hanya AUTHOR yang lihat ini
     */
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role === 'author';
    }
}
