<?php

namespace BenjaminHansen\FilamentLogger;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use BenjaminHansen\FilamentLogger\Filament\Resources\ActivityResource;
use Closure;

class FilamentLoggerPlugin implements Plugin
{
    use EvaluatesClosures;

    protected bool|Closure|null $showNavigation = null;

    public function getId(): string
    {
        return 'filament-logger';
    }

    public function register(Panel $panel): void
    {
        ActivityResource::setNavigationVisibility($this->evaluate($this->showNavigation));

        $panel->resources([
            ActivityResource::class
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public function showNavigation(bool|Closure $show = true): static
    {
        $this->showNavigation = $show;

        return $this;
    }

    public static function make(): static
    {
        $plugin = app(static::class);

        // defaults
        $plugin->showNavigation(false);

        return $plugin;
    }
}
