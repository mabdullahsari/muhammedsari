<?php declare(strict_types=1);

namespace App\Filament;

use Illuminate\Support\AggregateServiceProvider;

final class FilamentServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
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
