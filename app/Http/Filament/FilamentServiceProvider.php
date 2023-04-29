<?php declare(strict_types=1);

namespace App\Http\Filament;

use Illuminate\Support\AggregateServiceProvider;

final class FilamentServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \Blogging\BloggingServiceProvider::class,
        \Database\DatabaseServiceProvider::class,
        \Monitoring\MonitoringServiceProvider::class,
        \Publishing\PublishingServiceProvider::class,
        \Scheduling\SchedulingServiceProvider::class,

        \BladeUI\Icons\BladeIconsServiceProvider::class,
        \BladeUI\Heroicons\BladeHeroiconsServiceProvider::class,
        \Filament\FilamentServiceProvider::class,
        \Filament\Forms\FormsServiceProvider::class,
        \Filament\Notifications\NotificationsServiceProvider::class,
        \Filament\Support\SupportServiceProvider::class,
        \Filament\Tables\TablesServiceProvider::class,
        \Illuminate\Foundation\Support\Providers\RouteServiceProvider::class,
        \Livewire\LivewireServiceProvider::class,
        \RyanChandler\BladeCaptureDirective\BladeCaptureDirectiveServiceProvider::class,
        \ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthServiceProvider::class,
        \Spatie\FilamentMarkdownEditor\MarkdownEditorServiceProvider::class,
    ];
}
