<?php declare(strict_types=1);

namespace App\Http\Admin;

use App\Http\Admin\Blog\Post\Post;
use App\Http\Admin\Blog\Tag\Tag;
use App\Http\Admin\Contact\ContactForm\ContactForm;
use App\Http\Admin\Dashboard\HorizonWidget;
use App\Http\Admin\General\ApplicationHealth;
use App\Http\Admin\Schedule\Publication\Publication;
use App\Http\Admin\SpamPrevention\Quarantine\QuarantinedMessage;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;

final class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->authMiddleware([Authenticate::class])
            ->colors(['primary' => Color::Amber])
            ->default()
            ->id($path = $this->app['config']['filament.path'])
            ->login()
            ->middleware(['web', DisableBladeIconComponents::class, DispatchServingFilamentEvent::class])
            ->pages([Dashboard::class])
            ->path($path)
            ->plugin(FilamentSpatieLaravelHealthPlugin::make()->usingPage(ApplicationHealth::class))
            ->resources([
                ContactForm::class,
                Post::class,
                Publication::class,
                Tag::class,
                QuarantinedMessage::class,
            ])
            ->widgets([AccountWidget::class, HorizonWidget::class]);
    }
}
