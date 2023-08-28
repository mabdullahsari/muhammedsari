<?php declare(strict_types=1);

namespace App\Http\Admin;

use Filament\Actions\ActionsServiceProvider;
use Filament\Infolists\InfolistsServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use Illuminate\Support\AggregateServiceProvider;
use Kirschbaum\PowerJoins\PowerJoinsServiceProvider;

final class AdminServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        AdminPanelProvider::class,

        \App\AppServiceProvider::class,
        \Blogging\BloggingServiceProvider::class,
        \Contacting\ContactingServiceProvider::class,
        \Monitoring\MonitoringServiceProvider::class,
        \PreservingData\PreservingDataServiceProvider::class,
        \Publishing\PublishingServiceProvider::class,
        \Scheduling\SchedulingServiceProvider::class,

        \App\Http\RouteServiceProvider::class,
        \BladeUI\Icons\BladeIconsServiceProvider::class,
        \BladeUI\Heroicons\BladeHeroiconsServiceProvider::class,
        \Kirschbaum\PowerJoins\PowerJoinsServiceProvider::class,
        \Filament\FilamentServiceProvider::class,
        \Filament\Actions\ActionsServiceProvider::class,
        \Filament\Forms\FormsServiceProvider::class,
        \Filament\Infolists\InfolistsServiceProvider::class,
        \Filament\Notifications\NotificationsServiceProvider::class,
        \Filament\Support\SupportServiceProvider::class,
        \Filament\Tables\TablesServiceProvider::class,
        \Filament\Widgets\WidgetsServiceProvider::class,
        \Livewire\LivewireServiceProvider::class,
        \RyanChandler\BladeCaptureDirective\BladeCaptureDirectiveServiceProvider::class,
        \ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthServiceProvider::class,
    ];
}
