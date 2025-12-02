<?php

namespace BenjaminHansen\FilamentLogger;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use BenjaminHansen\FilamentLogger\Filament\Resources\ActivityResource;

class FilamentLoggerPlugin implements Plugin
{
    protected bool $showNavigation = false;

    public function getId(): string
    {
        return 'filament-logger';
    }

    public function register(Panel $panel): void
    {
        ActivityResource::setNavigationVisibility($this->showNavigation);

        $panel->resources([
            ActivityResource::class
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public function showNavigation(bool $show = true): static
    {
        $this->showNavigation = $show;

        return $this;
    }

    public static function make(): static
    {
        return new static();
    }
}
