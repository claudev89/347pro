<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Admin123PanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin123')
            ->path('admin123')
            ->login()
            ->colors([
                'primary' => '#13BCE3',
                'secondary' => '#F6F6F6',
            ])
            ->viteTheme('resources/css/filament/admin123/theme.css')
            ->darkMode(false)
            ->brandLogo('http://127.0.0.1:8000/logo.png')
            ->brandLogoHeight('3rem')
            ->favicon('https://347pro.cl/img/favicon.ico')
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Pedidos')
                    ->icon('heroicon-s-shopping-bag')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Catálogo')
                    ->icon('heroicon-s-building-storefront')
                    ->collapsed(),
                NavigationGroup::make()
                    ->label('Clientes')
                    ->icon('heroicon-s-users')
                    ->collapsed(),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([

            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([

            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
