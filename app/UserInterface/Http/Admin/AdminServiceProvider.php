<?php declare(strict_types=1);

namespace App\UserInterface\Http\Admin;

use Illuminate\Support\AggregateServiceProvider;

final class AdminServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        \App\InfrastructureServiceProvider::class,
        \Blogging\BloggingServiceProvider::class,
        \Contacting\ContactingServiceProvider::class,
        \Monitoring\MonitoringServiceProvider::class,
        \Publishing\PublishingServiceProvider::class,
        \Scheduling\SchedulingServiceProvider::class,

        \App\UserInterface\Http\RouteServiceProvider::class,
        \BladeUI\Icons\BladeIconsServiceProvider::class,
        \BladeUI\Heroicons\BladeHeroiconsServiceProvider::class,
        \Filament\FilamentServiceProvider::class,
        \Filament\Forms\FormsServiceProvider::class,
        \Filament\Notifications\NotificationsServiceProvider::class,
        \Filament\Support\SupportServiceProvider::class,
        \Filament\Tables\TablesServiceProvider::class,
        \Livewire\LivewireServiceProvider::class,
        \RyanChandler\BladeCaptureDirective\BladeCaptureDirectiveServiceProvider::class,
        \ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthServiceProvider::class,
        \Spatie\FilamentMarkdownEditor\MarkdownEditorServiceProvider::class,
    ];
}
